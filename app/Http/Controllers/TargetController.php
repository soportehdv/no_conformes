<?php

namespace App\Http\Controllers;


use App\Models\Stock;
use App\Models\Ventas;
use App\Models\User;
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
        $user = User::all();

        $ventas2 = Ventas::join('clientes', 'clientes.id', '=', 'ventas.cliente_id')
            ->join('users', 'users.id', '=', 'ventas.user_id')
            ->join('compras', 'compras.id', '=', 'ventas.producto_id')
            ->select('ventas.id', 'ventas.unidades', 'ventas.nombre', 'ventas.cargorecibe', 'ventas.devolucion', 'clientes.responsable_id AS cliente', 'clientes.departamento AS ubicacion', 'users.name AS Vendedor', 'ventas.created_at AS Fecha', 'compras.serial AS serial')
            ->orderby('ventas.created_at', 'desc')
            ->get();


        return view('targets/target',[
            'clientes'  => $clientes,
            'compras'  => $compras,
            'ubicacion' => $ubicacion,
            'ventas'  => $ventas,
            'user' => $user,
            'ventas2'  => $ventas2,


        ]);
    }
}
