<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Compras;
use App\Models\Clientes;
use App\Models\Ubicacion;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class DevolucionController extends Controller
{
    public function getDevolucion(Request $request)
    {


        if ($request->get('filtro') == null) { //Todas las busquedas

            $query= trim($request->get('search'));
            $compras = Compras::join('estados', 'estados.id', '=', 'compras.estado_id')
            ->select('compras.*', 'estados.estado as estados')
            ->where('compras.serial','LIKE', '%' . $query . '%')
            // ->get();
            ->paginate(10);

            return view('devolucion/list', [
                'search' => $query,
                'compras' => $compras
            ]);
        }  else
                if ($request->get('filtro') == 1) { //Más recientes
                    $compras = Compras::join('estados', 'estados.id', '=', 'compras.estado_id')
                    ->select('compras.*', 'estados.estado as estados')
                    ->orderby('compras.created_at', 'asc')
                    // ->get();
                    ->paginate(10);


                    return view('devolucion/list', [
                        'compras' => $compras
                    ]);
        } else
                if ($request->get('filtro') == 2) { // Más antiguos
                    $compras = Compras::join('estados', 'estados.id', '=', 'compras.estado_id')
                    ->select('compras.*', 'estados.estado as estados')
                    ->orderby('compras.created_at', 'desc')
                    // ->get();
                    ->paginate(10);

                    return view('devolucion/list', [
                        'compras' => $compras
                    ]);
        }

    }
    public function fechaVista(Request $request){
        $start = Carbon::parse($request->get('fecha_inicial'));
        $end = Carbon::parse($request->get('fecha_final'));
        $compras = Compras::join('estados', 'estados.id', '=', 'compras.estado_id')
        ->select('compras.*', 'estados.estado as estados')
        ->whereDate('compras.created_at','<=',$end)
        ->whereDate('compras.created_at','>=',$start)
        ->get();

        return view('devolucion/listfiltro', [
            'compras' => $compras
        ]);
    }
}
