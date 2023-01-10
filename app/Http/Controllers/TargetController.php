<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\Files;
use App\Models\Estados;
use App\Models\Tramite;
use App\Models\NConforme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class TargetController extends Controller
{
    public function gettarget(Request $request)
    {
        $user = User::all();


        return view('targets/target',[
            'user' => $user,
        ]);
    }
    public function getRadicado(Request $request)
    {
            $files      = Files::all();
            $user       = User::all();
            $tramite    = Tramite::all();
            $estado     = Estados::all();
            $NConformes = NConforme::join('users', 'users.id', '=', 'NConformes.proceso')
                ->join('users as user', 'user.id', '=', 'NConformes.nCproceso')
                ->select('users.cargo as Aservicio', 'users.name as reportante', 'user.cargo as servicio', 'user.name as nCreportado', 'NConformes.*')
                ->get();
            // dd($NConformes);
            return view('targets/radicado', [
                'NConformes'    => $NConformes,
                'user'          => $user,
                'files'         => $files,
                'tramite'       => $tramite,
                'estado'        => $estado,
            ]);
    }

    public function getRadicadoPendiente(Request $request)
    {
            $files      = Files::all();
            $user       = User::all();
            $tramite    = Tramite::all();
            $estado     = Estados::all();
            $NConformes = NConforme::join('users', 'users.id', '=', 'NConformes.proceso')
                ->join('users as user', 'user.id', '=', 'NConformes.nCproceso')
                ->select('users.cargo as Aservicio', 'users.name as reportante', 'user.cargo as servicio', 'user.name as nCreportado', 'NConformes.*')
                ->where('radicado', '=', null)
                ->get();
            // dd($NConformes);
            return view('targets/radicadoPendiente', [
                'NConformes'    => $NConformes,
                'user'          => $user,
                'files'         => $files,
                'tramite'       => $tramite,
                'estado'        => $estado,
            ]);
    }
}
