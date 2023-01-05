<?php

namespace App\Http\Controllers;
use Mail;
use App\Models\Tipo;
use App\Models\User;
use App\Models\Files;
use App\Models\Ventas;
use App\Models\Compras;
use App\Models\Estados;
use App\Models\Tramite;
use App\Models\NConforme;
use App\Models\Ubicacion;
use App\Models\Fracciones;
use App\Events\TramiteEvent;
use Illuminate\Http\Request;
use App\Models\subcategorias;
use App\Events\NconformeEvent;
use Illuminate\Support\Facades\DB;
use App\Listeners\NconformeListener;
use App\Http\Controllers\Subcategoria;
use Illuminate\Support\Facades\Validator;
use App\Notifications\TramiteNotification;
use App\Notifications\NconformeNotification;


class NconformeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('admin');

    }

    public function getNConformes(Request $request)
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
            return view('NConformes/lista', [
                'NConformes'    => $NConformes,
                'user'          => $user,
                'files'         => $files,
                'tramite'       => $tramite,
                'estado'        => $estado,
            ]);
    }
    public function enviadosConformes(Request $request){
            $files      = Files::all();
            $tramite    = Tramite::all();
            $estados    = Estados::all();
            $user       = User::all();

            $NConformes = NConforme::join('users', 'users.id', '=', 'NConformes.proceso')
                ->join('users as user', 'user.id', '=', 'NConformes.nCproceso')
                ->select('users.cargo as Aservicio', 'users.name as reportante', 'user.cargo as servicio', 'user.name as nCreportado', 'NConformes.*')
                ->get();
            // dd($NConformes);
            return view('NConformes/enviados', [
                'NConformes' => $NConformes,
                'files'      => $files,
                'tramite'    => $tramite,
                'estados'    => $estados,
                'user'       => $user,

            ]);
    }

    public function asignadosConformes(Request $request){
        $files      = Files::all();
        $tramite    = Tramite::all();
        $estados    = Estados::all();
        $user       = User::all();

        $NConformes = NConforme::join('users', 'users.id', '=', 'NConformes.proceso')
            ->join('users as user', 'user.id', '=', 'NConformes.nCproceso')
            ->select('users.cargo as Aservicio', 'users.name as reportante', 'user.cargo as servicio', 'user.name as nCreportado', 'NConformes.*')
            ->get();
        // dd($NConformes);
        return view('NConformes/asignados', [
            'NConformes' => $NConformes,
            'files'      => $files,
            'tramite'    => $tramite,
            'estados'    => $estados,
            'user'       => $user,

        ]);
    }

    public function createN()
    {
        $subProceso = user::all();


        return view('NConformes/create', [
            'subProceso' => $subProceso,
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
        $noC->nCproceso     = $request->input('nCproceso');
        $noC->nCdescripcion = $request->input('nCdescripcion');
        $noC->nCacciones    = $request->input('nCacciones');
        $noC->accion        = $request->input('accion');

        if($request->file != null){
            $noC->imagen        = 1;
        }else{
            $noC->imagen        = 0;
        }
        $noC->save();

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
            'nCproceso'         =>  $request->nCproceso,
            'nCdescripcion'     =>  $request->nCdescripcion,
            'nCacciones'        =>  $request->nCacciones,
            'accion'            =>  $request->accion,
        );
        }
        // try {


        //     Mail::send('Emails.pqrd', $data, function ($message) use ($request) {
        //         $message->from('sistemas.soportehdv2@gmail.com', 'HOSPITAL DEPARTAMENTAL DE VILLAVICENCIO');
        //         $message->to($request->user, $request->reportado)->subject('Remitente');
        //         $message->cc($request->user, 'Hospital Villavicencio');
        //         $message->subject('Notificación nuevo PQRSF de: ' . $request->nombre . ' asunto: ' . $request->asunto );
        //     });



        // } catch (\Exception $e) {
        //     return back()->with('status2', 'Falló envio de PQRD, por favor intente mas tarde.');
        // }

        // return back()->with('status', '¡PQRD enviado exitosamente!');
        //Finalización para enviar al correo electronico
        // User::where('id', $noC->nCproceso)->first()->notify(new NconformeNotification($noC));
        // User::where('id', 5)->first()->notify(new NconformeNotification($noC));
        event(new NconformeEvent($noC));

        $request->session()->flash('alert-success', 'No conforme registrado con exito!');
        return redirect()->route('NConformes.lista');
    }

    public function vista($id)
    {

        $NConforme  = NConforme::where('id', $id)->first();
        $estado     = Estados::all();
        $tramite    = Tramite::all();
        $files      = Files::all();
        $user       = User::all();
        $user2      = User::all();


        // $fracciones = Fracciones::all();

        return view('NConformes/vista', [
            'NConforme' => $NConforme,
            'estado'    => $estado,
            'tramite'   => $tramite,
            'files'     => $files,
            'user'      => $user,
            'user2'     => $user2,

            // 'fracciones' => $fracciones
        ]);
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
            $noC->aDescripcion  = $request->input('aDescripcion');
        }
        $noC->save();

        $request->session()->flash('alert-success', 'No conforme actualizado con exito!');
        return redirect()->route('NConformes.lista');
    }
    public function updateProducto($compra_id, $id_venta)
    {

        $NConforme = NConforme::where('id', $id)->first();
        $estado = Estados::all();
        $user = User::all();

        return view('Compras/editarProducto', [
            'NConforme' => $NConforme,
            'estado' => $estado,
            'user' => $user,
        ]);
    }
    public function updateRadicado(Request $request, $nC_id){
        $noC = NConforme::where('id', $nC_id)->first();

        $validate = Validator::make($request->all(), [
            'radicado'     => 'required'
        ]);

        if ($validate->fails()) {
            $request->session()->flash('alert-danger', 'Error al actualizar producto');
            return redirect()->back();
        }

        $noC->radicado     = $request->input('radicado');
        $noC->save();

        $request->session()->flash('alert-success', 'Radicado ingresado con exito!');
        return redirect()->route('listaRadicado.radicado');
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

    public function download($id){
        $files = Files::find($id);
        $pathtoFile = public_path().'/'.'files/biblioteca'.'/'.$files->ruta;
        return response()->download($pathtoFile);
    }

    public function index(){
        $Nconformenotificacion = auth()->user()->unreadNotifications;

        return view('NConformes.notificacion',[
            'Nconformenotificacion' => $Nconformenotificacion,
        ]);
    }

    public function markNotification(Request $request)
    {
        auth()->user()->unreadNotifications
                ->when($request->input('id'), function($query) use ($request){
                    return $query->where('id', $request->input('id'));
                })->markAsRead();
        return response()->noContent();
    }

    public function markNotification2(Request $request)
    {
        auth()->user()->unreadNotifications
                ->when($request->input('id'), function($query) use ($request){
                    return $query->where('id', $request->input('id'));
                })->markAsRead();
        return response()->noContent();
    }

    public function createT($NConforme)
    {
        $NConforme = NConforme::where('id', $NConforme)->first();
        $subProceso = user::all();


        return view('NConformes.tramite', [
            'NConforme' => $NConforme,
            'subProceso' => $subProceso
        ]);
    }

    public function createTramite(Request $request)
    {

        //validamos los datos
        $validate = request()->validate( [
            'observacion'      => 'required',
        ],[
            'reasignar.required'      => 'Es obligatorio escribir una observación',
        ]);

        $totalFiles  = Files::all();
        if ($request->file != null) {
            if($totalFiles->last() != null){
                $ultimaImagen = $totalFiles->last()->id + 1;
            }else{
                $ultimaImagen = 1;
            }
        }else{
            $ultimaImagen = 0;
        }


        // inicio, si se hace una asignacion a otro usuario
        if ($request->input('proceso2')) {
            // dd('condicion 1');
            $tramite = new Tramite;
            $tramite->nConforme     = $request->input('nConforme');
            $tramite->tramite       = $request->input('tramite');
            $tramite->observacion   = $request->input('reportanteoculto');
            $tramite->tramite_img   = $ultimaImagen;
            $tramite->file          = 0;
            $tramite->nCproceso     = $request->input('proceso2');

            foreach (NConforme::all() as $noConf) {
                if ($noConf->id == $tramite->nConforme) {
                    if ($noConf->asignado > 0) {
                        $tramite->proceso    = auth()->user()->id;
                    }else{
                        $tramite->proceso    = $noConf->proceso;
                    }
                }
            }
            // dd($tramite);

            $tramite->save();

            User::where('id', $tramite->nCproceso )->first()->notify(new TramiteNotification($tramite));
            User::where('id', $tramite->proceso )->first()->notify(new TramiteNotification($tramite));
            User::where('id', 5)->first()->notify(new TramiteNotification($tramite));

            $noCTra = NConforme::where('id', $tramite->nConforme)->first();
            $noCTra->status     = $tramite->tramite;
            $noCTra->asignado   = $tramite->nCproceso;
            $noCTra->save();
        }
        // fin, si se hace una asiganacion a otro usuario
        else{
            $tramite = new Tramite;
            $tramite->nConforme     = $request->input('nConforme');
            $tramite->tramite       = $request->input('tramite');
            $tramite->observacion   = $request->input('observacion');
            $tramite->tramite_img   = $ultimaImagen;
            if($request->file != null){
                $tramite->file      = 1;
            }else{
                $tramite->file      = 0;
            }
            foreach (NConforme::all() as $noConf) {
                if ($noConf->id == $tramite->nConforme) {
                        if ($noConf->asignado > 0) {
                            $tramite->proceso    = $noConf->proceso;
                            $tramite->nCproceso  = $noConf->asignado;
                        }else{
                            $tramite->proceso    = $noConf->proceso;
                            $tramite->nCproceso  = $noConf->nCproceso;
                        }
                }
            }
            $tramite->save();

            User::where('id', $tramite->proceso )->first()->notify(new TramiteNotification($tramite));
            User::where('id', 5)->first()->notify(new TramiteNotification($tramite));



            // fecha de cierre
            $noCTra = NConforme::where('id', $tramite->nConforme)->first();
            $noCTra->status     = $tramite->tramite;
            // actualizamos fecha de finalizacion
            if ($request->input('tramite') == "5") {
                $now = new \DateTime();
                $finalizacion = $now->format('Y-m-d H:i:s');
                // dd($finalizacion);
                $noCTra->NcFinalizado = $finalizacion;
            }
            $noCTra->save();
        }

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
            $file->aDescripcion  = $request->input('aDescripcion');

            // $NConforme = NConforme::all();
            // $noCon = $NConforme->last()->id;
            $file->noConforme    = $request->input('nConforme');
            $file->save();
        }





        $request->session()->flash('alert-success', 'registrado con exito!');
        return redirect()->route('NConformes.lista');
    }

}
