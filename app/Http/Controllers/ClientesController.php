<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Lotes;
use App\Models\Stock;
use App\Models\Compras;
use App\Models\Clientes;
use App\Models\Ubicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ClientesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');

    }

    public function getClientes(Request $request)
    {

        if ($request->get('filtro') == null){
            if($request){

                $query= trim($request->get('search'));
                $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                ->select('clientes.*', 'users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'clientes.estado')
                ->where('clientes.departamento','LIKE', '%' . $query . '%')
                ->orderBy('id', 'asc')
                // ->get();
                ->simplePaginate(20);

            }
            return view('Clientes/mostrar', [
                'clientes' => $clientes,
                'search' => $query
            ]);


        } else
            if($request->get('filtro') == 1){ //mas reciente
                $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                ->select('clientes.*', 'users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'clientes.estado')
                ->orderby('updated_at', 'desc')
                // ->get();
                ->simplePaginate(20);


                return view('Clientes/mostrar', [
                    'clientes' => $clientes
                ]);
            }else

                    if ($request->get('filtro') == 2){//Alfabetico
                        $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                        ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                        ->select('clientes.*', 'users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'clientes.estado' )
                        ->orderby('tipo', 'desc')
                        // ->get();
                        ->simplePaginate(20);


                        return view('Clientes/mostrar', [
                            'clientes' => $clientes
                        ]);
                    }else
                            if ($request->get('filtro') == 3){//Alfabetico
                                $clientes = Clientes::join('users', 'users.id', '=', 'clientes.responsable_id')
                                ->join('ubicacions', 'ubicacions.id', '=', 'clientes.departamento')
                                ->select('users.name AS responsable', 'users.cargo AS cargo', 'ubicacions.nombre AS ubicacion', 'clientes.*')
                                ->orderby('entregado','desc')
                                // ->get();
                                ->simplePaginate(20);


                                return view('Clientes/mostrar', [
                                    'clientes' => $clientes
                                ]);
                            }


    }

    public function create()
    {
        $ubicacion = Ubicacion::all();
        $clientes = Clientes::all();
        $compras = Compras::all();

        return view('Clientes/create', [
            'ubicacion' => $ubicacion,
            'clientes' => $clientes,
            'compras' => $compras,

        ]);
    }

    public function createClientes(Request $request)
    {
        // dd($request->all());

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'departamento'      => 'required',
        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }

        $ubicacion = Ubicacion::all();

        $cantidad = $request->input('cantidad');
        $tipo = $request->input('tipo');
        $departamento = $request->input('departamento');
        $registro = $request->input('registro');
        $direccion = $request->input('direccion');




        //recorremos todos lo datos
        for($i=0; $i < count($cantidad); $i++){

            // $clientes = new Clientes();
            $datasave =[
                'responsable_id' => Auth::user()->id,
                'departamento' => $departamento[0],
                'registro' => $registro[0],
                'tipo' => $tipo[$i],
                'cantidad' => $cantidad[$i],
                'entregado' => $cantidad[$i],
                'direccion' => $direccion[0],
                'created_at'  => Carbon::now()->toDateTimeString(),
                'updated_at'  => Carbon::now()->toDateTimeString()
            ];

            // envio a la base de datos
            // dd($datasave);
            DB::table('clientes')->insert($datasave);
        }



        $request->session()->flash('alert-success', 'Cliente registrado con exito!');

        return redirect()->route('clientes.lista');
    }

    public function update($id)
    {
        $clientes = Clientes::where('id', $id)->first();
        $ubicacion = Ubicacion::all();
        $compras = Compras::all();
        $user = User::all();


        return view('Clientes/edit', [
            'cliente' => $clientes,
            'ubicacion' => $ubicacion,
            'compras' => $compras,
            'user' => $user,
        ]);
    }

    public function updateClientes(Request $request, $clientes_id)
    {
        // dd($request->all());

        $clientes = Clientes::where('id', $clientes_id)->first();

        //validamos los datos
        $validate = Validator::make($request->all(), [

            'estado'      => 'required',



        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error almacenando los datos');

            return redirect()->back();
        }
        $ubicacion = Ubicacion::all();


        // $clientes->responsable_id = $request->input('responsable');
        $clientes->nombre =  $request->input('name');
        $clientes->estado =  $request->input('estado');
        $clientes->cargorecibe =  $request->input('cargorecibe');
        $clientes->departamento = $request->input('departamento');
        $clientes->registro = $request->input('registro');
        $clientes->tipo = $request->input('tipo');
        $clientes->cantidad = $request->input('cantidad');
        $clientes->entregado = $request->input('cantidad');
        $clientes->direccion = $request->input('direccion');
        $clientes->save();

        $request->session()->flash('alert-success', 'Cliente actualizado con exito!');


        return redirect()->route('clientes.lista');
    }



    public function getOneClient(Request $request)
    {

        $dui = $request->input('dui');
        $cliente = Clientes::where('dui', $dui)->first();

        $compras = Compras::all();

        $lotes = Lotes::all();

        return view('ventas/create', [
            'cliente' => $cliente
        ]);
    }


    public function deleteClientes()
    {
    }
}
