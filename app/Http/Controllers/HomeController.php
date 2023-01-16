<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::user()->rol == 'servicios')
            return redirect()->route('NConformes.lista');
        elseif(Auth::user()->rol == 'admin')
            return redirect()->route('NConformes.lista');
        elseif(Auth::user()->rol == 'ventanilla')
            return redirect()->route('listaRadicado.radicado');
        elseif(Auth::user()->rol == 'general')
            return redirect()->route('NConformes.vistaGeneral');
    }
}
