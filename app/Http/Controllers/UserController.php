<?php

namespace App\Http\Controllers;

use Datatables;
use App\Models\User;
use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{

    public function __construct()
    {
        // $this->middleware('auth');
        // $this->middleware('admin');

    }



    public function getUser(Request $request)
    {
            $user= User::all();
            // dd(User::all());

            return view('user/lista', [
                'users' => $user,
            ]);
    }

    public function create()
    {
        return view('user/create');
    }

    public function createUser(Request $request)
    {

        //validamos los datos
        $validate = request()->validate( [
            'name'      => 'required',
            'cargo'     => 'required',
            'email'     => 'required',
            'rol'       => 'required',
            'password'  => ['required','min:6','confirmed'],
        ],[
            'name.required'      => 'El campo nombre es obligatorio',
            'cargo.required'      => 'El campo cargo es obligatorio',
            'email.required'      => 'El campo correo es obligatorio',
            'rol.required'      => 'El campo rol es obligatorio',
            'password.required'  => 'El campo contraseña es obligatorio',
            'password.min'  => 'La contraseña debe tener al menos 6 caracteres',
            'password.confirmed'  => 'Las contraseñas no coinciden',
        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->cargo = $request->input('cargo');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->rol = $request->input('rol');
        $user->save();
        $request->session()->flash('alert-success', 'Usuario registrado con exito!');


        return redirect()->route('user.lista');
    }

    public function update($id)
    {
        $user = User::where('id', $id)->first();

        return view('user/edit', [
            'user' => $user
        ]);
    }

    public function updateUser(Request $request, $user_id)
    {
        $user = User::where('id', $user_id)->first();

        if ($request->input('password') != null) {
            //validamos los datos
            $validate = request()->validate( [
                'password'  => ['required','min:6','confirmed'],
            ],[
                'password.required'  => 'El campo contraseña es obligatorio',
                'password.min'  => 'La contraseña debe tener al menos 6 caracteres',
                'password.confirmed'  => 'Las contraseñas no coinciden',
            ]);

            $user->password = bcrypt($request->input('password'));
            $user->save();
        }
        else{
            //validamos los datos
         $validate = request()->validate( [
            'name'      => 'required',
            'cargo'     => 'required',
            'email'     => 'required',
            'rol'       => 'required',
        ],[
            'name.required'      => 'El campo nombre es obligatorio',
            'cargo.required'      => 'El campo cargo es obligatorio',
            'email.required'      => 'El campo correo es obligatorio',
            'rol.required'      => 'El campo rol es obligatorio',
        ]);


        $user->name = $request->input('name');
        $user->cargo = $request->input('cargo');
        $user->email = $request->input('email');
        $user->rol = $request->input('rol');
        $user->save();
        }


        $request->session()->flash('alert-success', 'Usuario actualizado con exito!');


        return redirect()->route('user.lista');
    }


    public function deleteUser()
    {
    }

    public function misDatos(){
        $files = Files::all();

        return view('user.perfil',[
            'files' => $files
        ]);

    }

    public function misDatosUsuario(Request $request){
        $user           = Auth::user();
        $userId         = $user->id;
        $userEmail      = $user->email;
        $userPassword   = $user->password;
        // dd($request->all());
        if($request->file != null){
            $file = new Files();
            $file->nombre       = $request->file->getClientOriginalName();
            $file->extension    = $request->file->getClientOriginalExtension();
            $file->ruta         = str_replace(" ","_",date('Y-m-d').'_'.$file->nombre);
            $tipo               = explode('/', $request->file->getClientMimeType() );
            $file->mime         = $tipo[0];
            $file->size         = number_format($request->file->getSize()/1024,2,',','.');
            /*primero muevo el archivo antes de generar un registro en la bd por si se presenta fallos de permisos en la subida, no me genere
            registros basura en la bd*/
            $request->file->move( public_path('files/biblioteca'), $file->ruta);
            $file->aDescripcion  = "";

            // $NConforme = NConforme::all();
            // $noCon = $NConforme->last()->id;
            $file->noConforme    = 0;
            $file->save();
            // guardamos dato en user
            $fil    = Files::all();
            $fi     = $fil->last()->id;
            $users  = User::all();
            $user->image = $fi;
            $user->save();

        }

        if($request->password_actual !=""){
            $NuewPass   = $request->password;
            $confirPass = $request->confirm_password;
            $userEmail      = $user->email;

                //Verifico si la clave actual es igual a la clave del usuario en session
                if (Hash::check($request->password_actual, $userPassword)) {

                    //Valido que tanto la 1 como 2 clave sean iguales
                    if($NuewPass == $confirPass){
                        //Valido que la clave no sea Menor a 6 digitos
                        if(strlen($NuewPass) >= 6){
                            $user->password = Hash::make($request->password);
                            $sqlBD = DB::table('users')
                                  ->where('id', $user->id)
                                  ->update(['password' => $user->password], ['email' => $user->email]);
                            return redirect()->back()->with('updateClave','La clave fue cambiada correctamente.');

                        }else{
                            return redirect()->back()->with('clavemenor','Recuerde la clave debe ser mayor a 6 digitos.');
                        }

                }else{
                    return redirect()->back()->with('claveIncorrecta','Por favor verifique las claves no coinciden.');
                }

            }else{
                return back()->withErrors(['password_actual'=>'La Clave no Coinciden']);
            }


        }
        elseif($request->email != $userEmail){
            $name       = $request->name;
            $sqlBDUpdateName = DB::table('users')
                            ->where('id', $user->id)
                            ->update(['name' => $name]);
            return redirect()->back()->with('name','El nombre fue cambiado correctamente.');;

        }

    }
}
