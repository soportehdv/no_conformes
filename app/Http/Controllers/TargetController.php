<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use App\Models\Compras;
use App\Models\Clientes;
use App\Models\Ventas;
use Illuminate\Http\Request;


class TargetController extends Controller
{
    public function gettarget(Request $request)
    {
        $clientes = Clientes::all();
        $compras = Compras::all();
        $ventas = Ventas::all();
        $stock = Stock::all();


        return view('targets/target',[
            'clientes'  => $clientes,
            'compras'  => $compras,
            'stock'  => $stock,
            'ventas'  => $ventas,

        ]);
    }
}
