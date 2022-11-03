<?php

namespace App\Http\Controllers;

use App\Models\Tipo;
use App\Models\Stock;
use App\Models\Ventas;
use App\Models\Compras;
use App\Models\Estados;
use App\Models\Ubicacion;
use App\Models\Fracciones;
use App\Models\subcategorias;
use App\Models\NConforme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Subcategoria;
use Illuminate\Support\Facades\Validator;







class NconformeController extends Controller
{
    public function __construct()
        {
            $this->middleware('auth');
            $this->middleware('admin');

        }

    public function getNConformes(Request $request)
    {
            $NConformes = NConforme::all();

            return view('NConformes/lista', [
                'NConformes' => $NConformes,
            ]);
    }
    public function createN()
    {
        // $subcategorias = Subcategorias::on('calidad')->whereId("6")->get();
        //     dd($subcategorias);
        $subProceso = subcategorias::on('calidad')->get();


        return view('NConformes/create', [
            'subProceso' => $subProceso
        ]);
    }

    public function createNoConforme(Request $request)
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

        // $stock->estado_id =  1;
        // $stock->unidades = 1;
        // $stock->uni = 1;
        // $stock->compra_id = $Compras->id;

        // $stock->status = 1;

        // $stock->save();

        $request->session()->flash('alert-success', 'Ingreso actualizado con exito!');

        return redirect()->route('compras.lista');
    }
    public function updateProducto($compra_id, $id_venta)
    {

        $compras = Compras::where('id', $compra_id)->first();
        $estado = Estados::all();
        $ventas = ventas::where('id', $id_venta)->first();
        $ubicacion = Ubicacion::all();

        $fracciones = Fracciones::all();

        return view('Compras/editarProducto', [
            'compras' => $compras,
            'estado' => $estado,
            'ubicacion' => $ubicacion,
            'ventas' => $ventas,

        ]);
    }
    public function updatecomprasProducto(Request $request, $compra_id, $id_venta)
    {
        // dd($request->input('unidades'));


        $Compras = Compras::where('id', $compra_id)->first();
        $stock = Stock::where('id', $compra_id)->first();
        $ventas = Ventas::where('id', $id_venta)->first();



        $validate = Validator::make($request->all(), [
            'unidades'      => 'required',
        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al devolver producto');

            return redirect()->back();
        }

        //Guardamos en el compras


        $Compras->unidades = $Compras->unidades + $request->input('unidades');
        $Compras->save();

        //Guardamos en el ventas


        $ventas->devolucion = $ventas->devolucion - $request->input('unidades');
        $ventas->save();


        // guardamos


        //Guardamos en el stock

        // $stock->unidades = $stock->unidades + $request->input('unidades');
        // $stock->save();

        $request->session()->flash('alert-success', 'Devolución con exito!');

        return redirect()->route('ventas.lista');
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


    public function subcategorias(Request $request){
        if(isset($request->texto)){
            $subcategorias = Subcategorias::on('calidad')->whereId($request->texto)->get();
            return response()->json(
                [
                    'lista' => $subcategorias,
                    'success' => true
                ]
                );
        }else{
            return response()->json(
                [
                    'success' => false
                ]
                );

        }

    }
}
