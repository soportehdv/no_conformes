<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Compras;
use App\Models\Stock;
use App\Models\Fracciones;
use App\Models\Ubicacion;
use App\Models\Estados;
use App\Models\Tipo;
use Illuminate\Support\Facades\Validator;







class ComprasController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('admin');

        }

    public function getCompras(Request $request)
    {
        if($request){

            $query= trim($request->get('search'));
            $compras = Compras::join('estados', 'estados.id', '=', 'compras.estado_id')
                ->select('estados.estado as estado', 'compras.*')
                ->where('serial','LIKE', '%' . $query . '%')
                ->where('status','LIKE', '%' . 1 . '%')
                ->orderBy('id', 'asc')
                ->paginate(10);

            return view('compras/lista', [
                'compras' => $compras,
                'search' => $query
            ]);
        }
    }
    public function create()
    {
        $estado = Estados::all();
        $Ubicacion = Ubicacion::all();
        $tipo = Tipo::all();



        return view('Compras/create', [
            'estado' => $estado,
            'ubicacion' => $Ubicacion,
            'tipo' => $tipo,

        ]);
    }

    public function createCompras(Request $request)
    {
        // dd($request->all());

        //validamos los datos
        $validate = Validator::make($request->all(), [
            'serial'      => 'required',

        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error en el almacenando los datos');

            return redirect()->back();
        }


        $Compras = new Compras();

        $Compras->serial = $request->input('serial');


        $Compras->estado_id =  1;
        $Compras->unidades = $request->input('cantidad');
        $Compras->uni = $request->input('cantidad');
        $Compras->elemento = $request->input('elemento');
        $Compras->caracteristicas = $request->input('caracteristicas');
        $Compras->ancho = $request->input('ancho');
        $Compras->largo = $request->input('largo');
        $Compras->color = $request->input('color');
        $Compras->tela = $request->input('tela');

        $Compras->status = 1;

        $Compras->save();

        //Guardamos en el stock

        $stock = new Stock();
        $stock->estado_id =  1;
        $stock->unidades = $request->input('cantidad');
        $stock->uni = $request->input('cantidad');
        $stock->compra_id = $Compras->id;

        $stock->status = 1;

        $stock->save();


        $request->session()->flash('alert-success', 'Producto registrado con exito!');

        return redirect()->route('compras.lista');
    }
    public function update($id)
    {
        $compras = Compras::where('id', $id)->first();
        $estado = Estados::all();

        // $fracciones = Fracciones::all();

        return view('Compras/editar', [
            'compras' => $compras,
            'estado' => $estado,

            // 'fracciones' => $fracciones
        ]);
    }
    public function updatecompras(Request $request, $compra_id)
    {

        $Compras = Compras::where('id', $compra_id)->first();
        $stock = Stock::where('id', $compra_id)->first();


        $validate = Validator::make($request->all(), [
            'unidades'      => 'color',
        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al actualizar producto');

            return redirect()->back();
        }

        //validamos los datos
        // $Compras = new Compras();
        $Compras->serial = $request->input('serial');


        $Compras->estado_id =  1;
        $Compras->unidades = 1;
        $Compras->uni = 1;
        $Compras->elemento = $request->input('elemento');
        $Compras->caracteristicas = $request->input('caracteristicas');
        $Compras->ancho = $request->input('ancho');
        $Compras->largo = $request->input('largo');
        $Compras->color = $request->input('color');
        $Compras->tela = $request->input('tela');

        $Compras->status = 1;


        $Compras->save();


        //Guardamos en el stock

        // $stock->estado_id =  1;
        // $stock->unidades = 1;
        // $stock->uni = 1;
        // $stock->compra_id = $Compras->id;

        // $stock->status = 1;

        // $stock->save();

        $request->session()->flash('alert-success', 'Ingreso actualizado con exito!');

        return redirect()->route('compras.lista');
    }
    public function updateProducto($id)
    {
        $compras = Compras::where('id', $id)->first();
        $estado = Estados::all();
        $ubicacion = Ubicacion::all();

        // $fracciones = Fracciones::all();

        return view('Compras/editarProducto', [
            'compras' => $compras,
            'estado' => $estado,
            'ubicacion' => $ubicacion,


            // 'fracciones' => $fracciones
        ]);
    }
    public function updatecomprasProducto(Request $request, $compra_id)
    {

        $Compras = Compras::where('id', $compra_id)->first();
        $stock = Stock::where('id', $compra_id)->first();


        $validate = Validator::make($request->all(), [
            'estado_id'      => 'required',
        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al devolver producto');

            return redirect()->back();
        }

        //validamos los datos

        $Compras->estado_id =  $request->input('estado_id');
        $Compras->estado_ubi =  $request->input('ubicacion');
        $Compras->unidades =  $Compras->unidades + 1;
        $Compras->save();


        //Guardamos en el stock

        $stock->estado_id =  $request->input('estado_id');
        $stock->estado_ubi =  $request->input('ubicacion');
        $stock->unidades =  $stock->unidades + 1;
        $stock->save();

        $request->session()->flash('alert-success', 'Devolución con exito!');

        return redirect()->route('devolucion.list');
    }
    public function updatecomprasCar($id){
        $compras = Compras::where('id', $id)->first();
        $stock   = Stock  ::where('id', $id)->first();

        //validamos los datos

        $compras->status =  0;
        $compras->save();


        //Guardamos en el stock

        $stock->status =  0;
        $stock->save();

        return redirect()->back();


    }
}
