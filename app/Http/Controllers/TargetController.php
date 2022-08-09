<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use App\Models\Ventas;
use App\Models\Compras;
use App\Models\Clientes;
use App\Models\ubicacion;
use App\Models\listalavado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TargetController extends Controller
{
    public function gettarget(Request $request)
    {
        $clientes = Clientes::all();
        $compras = Compras::all();
        $ventas = Ventas::all();
        $stock = Stock::all();
        $ubicacion = ubicacion::all();
        // $listalavado = listalavado::join('ubicacions', 'ubicacions.id', '=', 'listalavados.servicio')
        // ->select('ubicacions.nombre as nombre', 'listalavados.*')
        // ->get();

        // $listalavado = listalavado::selectRaw('SUM(unidades) as Total')
        // ->select('unidades' ,'servicio')
        // // ->where('servicio', 4)
        // ->groupBy('unidades' ,'servicio')
        // ->get();



        return view('targets/target',[
            'clientes'  => $clientes,
            'compras'  => $compras,
            'stock'  => $stock,
            'ubicacion' => $ubicacion,
            'ventas'  => $ventas,
            // 'listalavado' => $listalavado,

        ]);
    }
}
