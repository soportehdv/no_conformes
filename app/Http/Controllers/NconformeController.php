<?php

namespace App\Http\Controllers;
use Mail;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Ventas;
use App\Models\Compras;
use App\Models\Estados;
use App\Models\Ubicacion;
use App\Models\Fracciones;
use App\Models\subcategorias;
use App\Models\NConforme;
use App\Models\Files;
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
            $NConformes = NConforme::join('users', 'users.id', '=', 'NConformes.proceso')
                ->join('users as user', 'user.id', '=', 'NConformes.nCproceso')
                ->select('users.cargo as Aservicio', 'user.cargo as servicio', 'NConformes.*')
                ->get();

            return view('NConformes/lista', [
                'NConformes' => $NConformes,
            ]);
    }
    public function createN()
    {
        $subProceso = user::all();


        return view('NConformes/create', [
            'subProceso' => $subProceso
        ]);
    }

    public function createNoConforme(Request $request)
    {
        // dd($request->all());
        //inicio donde validamos los datos
        $validate = Validator::make($request->all(), [
            'reportado'     => 'required',
            'fReporte'      => 'required',
            'proceso'       => 'required',
            'reportante'    => 'required',
            'nCreportado'   => 'required',
            'nCproceso'     => 'required',
            'nCdescripcion' => 'required',
            'nCacciones'    => 'required',
            'accion'        => 'required',

        ]);

        if($validate->fails()){
            $request->session()->flash('alert-danger', 'Error en el almacenando los datos');

            return redirect()->back();
        }
        // finalizacion de validación de datos

        // guardamos en la base de datos
        $noC = new NConforme();
        $noC->reportado     = $request->input('reportado');
        $noC->fReporte      = $request->input('fReporte');
        $noC->proceso       = $request->input('proceso');
        $noC->reportante    = $request->input('reportante');
        $noC->nCreportado   = $request->input('nCreportado');
        $noC->nCproceso     = $request->input('nCproceso');
        $noC->nCdescripcion = $request->input('nCdescripcion');
        $noC->nCacciones    = $request->input('nCacciones');
        $noC->accion        = $request->input('accion');
        $noC->save();

        if($request->file != null){
            // dd("hola-mundo");
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
            $file->aDescripcion  = $request->input('aDescripcion');

            $NConforme = NConforme::all();
            $noCon = $NConforme->last()->id;
            $file->noConforme    = $noCon;
            $file->save();



        }

        //inicio de codigo para envio de notificacion del correo electronico
        // ultimo dato
        $NConforme = NConforme::all();
        $cod = $NConforme->last()->id;

        if($request->file != null){

        $data = array(
            // datos con archivos
            'reportado'         =>  $request->reportado,
            'fReporte'          =>  $request->fReporte,
            'proceso'           =>  $request->proceso,
            'reportante'        =>  $request->reportante,
            'nCreportado'       =>  $request->nCreportado,
            'nCproceso'         =>  $request->nCproceso,
            'nCdescripcion'     =>  $request->nCdescripcion,
            'nCacciones'        =>  $request->nCacciones,
            'accion'            =>  $request->accion,
            'file'              =>  $request->file,
            'aDescripcion'      =>  $request->aDescripcion,

        );
        }
        else{
        $data = array(

            'reportado'         =>  $request->reportado,
            'fReporte'          =>  $request->fReporte,
            'proceso'           =>  $request->proceso,
            'reportante'        =>  $request->reportante,
            'nCreportado'       =>  $request->nCreportado,
            'nCproceso'         =>  $request->nCproceso,
            'nCdescripcion'     =>  $request->nCdescripcion,
            'nCacciones'        =>  $request->nCacciones,
            'accion'            =>  $request->accion,
        );

        }

        try {


            Mail::send('Emails.pqrd', $data, function ($message) use ($request) {
                $message->from('sistemas.soportehdv2@gmail.com', 'HOSPITAL DEPARTAMENTAL DE VILLAVICENCIO');
                $message->to($request->user, $request->nombre)->subject('Remitente');
                $message->cc($request->email, 'Hospital Villavicencio');
                $message->subject('Notificación nuevo PQRSF de: ' . $request->nombre . ' asunto: ' . $request->asunto );
            });



        } catch (\Exception $e) {
            return back()->with('status2', 'Falló envio de PQRD, por favor intente mas tarde.');
        }

        return back()->with('status', '¡PQRD enviado exitosamente!');
        //Finalización para enviar al correo electronico

        $request->session()->flash('alert-success', 'Producto registrado con exito!');
        return redirect()->route('NConformes.lista');
    }

    public function update($id)
    {
        $NConforme = NConforme::where('id', $id)->first();
        $estado = Estados::all();
        $user = User::all();

        // $fracciones = Fracciones::all();

        return view('NConformes/editar', [
            'NConforme' => $NConforme,
            'estado' => $estado,
            'user' => $user,

            // 'fracciones' => $fracciones
        ]);
    }
    public function updateNoConformes(Request $request, $nC_id)
    {

        // $Compras = Compras::where('id', $compra_id)->first();
        // $stock = Stock::where('id', $compra_id)->first();
        $noC = NConforme::where('id', $nC_id)->first();



        $validate = Validator::make($request->all(), [
            'reportado'     => 'required',
            'fReporte'      => 'required',
            'proceso'       => 'required',
            'reportante'    => 'required',
            'nCreportado'   => 'required',
            'nCproceso'     => 'required',
            'nCdescripcion' => 'required',
            'nCacciones'    => 'required',
            'accion'        => 'required',

        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al actualizar producto');

            return redirect()->back();
        }

        // $noC = new NConforme();
        $noC->reportado     = $request->input('reportado');
        $noC->fReporte      = $request->input('fReporte');
        $noC->proceso       = $request->input('proceso');
        $noC->reportante    = $request->input('reportante');
        $noC->nCreportado   = $request->input('nCreportado');
        $noC->nCproceso     = $request->input('nCproceso');
        $noC->nCdescripcion = $request->input('nCdescripcion');
        $noC->nCacciones    = $request->input('nCacciones');
        $noC->accion        = $request->input('accion');
        if($request->file != null){
            // $archivo = new Files();
            $Dname       = $request->file->getClientOriginalName();
            $Dextension  = $request->file->getClientOriginalExtension();
            $noC->file       = str_replace(" ","_",date('Y-m-d').'_'.$Dname);
            $tipo        = explode('/', $request->file->getClientMimeType() );
            $Dmime       = $tipo[0];
            $Dsize       = number_format($request->file->getSize()/1024,2,',','.');
            /*primero muevo el archivo antes de generar un registro en la bd por si se presenta fallos de permisos en la subida, no me genere
            registros basura en la bd*/
            $request->file->move( public_path('files/biblioteca'), $noC->file);
        }
        $noC->aDescripcion  = $request->input('aDescripcion');
        $noC->save();

        $request->session()->flash('alert-success', 'No conforme actualizado con exito!');
        return redirect()->route('NConformes.lista');
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


    public function subcategorias(Request $request){
        if(isset($request->texto)){
            $subcategorias = user::whereId($request->texto)->get();
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
