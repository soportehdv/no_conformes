<?php

namespace App\Http\Controllers;


use App\Models\User;
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
}
