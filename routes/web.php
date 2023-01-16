<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

//USERS
Route::get('user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create.vista')->middleware('admin');
Route::post('user/create', [App\Http\Controllers\UserController::class, 'createUser'])->name('user.create')->middleware('admin');
Route::get('user/update/{user_id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update.vista')->middleware('admin');
Route::post('user/update/{user_id}', [App\Http\Controllers\UserController::class, 'updateUser'])->name('user.update')->middleware('admin');
Route::get('user/list', [App\Http\Controllers\UserController::class, 'getUser'])->name('user.lista')->middleware('admin');

// editar perfir
Route::get('misDatos', [App\Http\Controllers\UserController::class, 'misDatos'])->name('misDatos')->middleware('auth');
Route::post('misDatos/actualizar', [App\Http\Controllers\UserController::class, 'misDatosUsuario'])->name('misDatosUsuario');

//No conformes
Route::get('NConformes/lista', [App\Http\Controllers\NconformeController::class, 'getNConformes'])->name('NConformes.lista');
Route::get('NConformes/enviados', [App\Http\Controllers\NconformeController::class, 'enviadosConformes'])->name('NConformes.enviados');
Route::get('NConformes/index', [App\Http\Controllers\NconformeController::class, 'index'])->name('NConformes.index');
Route::get('NConformes/vista/{NConformes_id}', [App\Http\Controllers\NconformeController::class, 'vista'])->name('NConformes.vista');
Route::get('NConformes/create', [App\Http\Controllers\NconformeController::class, 'createN'])->name('NConformes.create.vista');
Route::post('NConformes/create', [App\Http\Controllers\NconformeController::class, 'createNoConforme'])->name('NConformes.create');
Route::get('NConformes/update/{NConformes_id}', [App\Http\Controllers\NconformeController::class, 'update'])->name('NConformes.update.vista');
Route::post('NConformes/update/{NConformes_id}', [App\Http\Controllers\NconformeController::class, 'updateNoConformes'])->name('NConformes.update');


Route::post('NConformes/subcategorias', [App\Http\Controllers\NconformeController::class, 'subcategorias']);
Route::get('NConformes/download/{id}', [App\Http\Controllers\NconformeController::class, 'download'])->name('NConformes.download');
// NConformes/asignados
Route::get('NConformes/asignados', [App\Http\Controllers\NconformeController::class, 'asignadosConformes'])->name('NConformes.asignados');

// general
Route::get('NConformes/createGeneral', [App\Http\Controllers\NconformeController::class, 'createNGeneral'])->name('NConformesGeneral.create.vista');
Route::post('NConformes/createGeneral', [App\Http\Controllers\NconformeController::class, 'createNoConformeGeneral'])->name('NConformesGeneral.create');
Route::get('NConformes/vistaGeneral', [App\Http\Controllers\NconformeController::class, 'vistaGeneral'])->name('NConformes.vistaGeneral');
Route::get('NConformes/listaGeneral', [App\Http\Controllers\NconformeController::class, 'getNConformesGeneral'])->name('NConformesGeneral.lista');
Route::get('NConformes/updateGeneral/{NConformes_id}', [App\Http\Controllers\NconformeController::class, 'updateGeneral'])->name('NConformesGeneral.update.vista');
Route::post('NConformes/updateGeneral/{NConformes_id}', [App\Http\Controllers\NconformeController::class, 'updateNoConformesGeneral'])->name('NConformesGeneral.update');


//tramite
Route::get('tramite/create/{Nconfome}', [App\Http\Controllers\NconformeController::class, 'createT'])->name('tramite.create.vista');
Route::post('tramite/create/{Nconfome}', [App\Http\Controllers\NconformeController::class, 'createTramite'])->name('tramite.create');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');
Route::post('/mark-as-read', [App\Http\Controllers\NconformeController::class, 'markNotification'])->name('markNotification');

Route::post('/mark-as-read2', [App\Http\Controllers\NconformeController::class, 'markNotification2'])->name('markNotification2');

Route::get('targets/target', [App\Http\Controllers\TargetController::class, 'gettarget'])->name('listatarget.target');

//ventanilla
Route::get('ventanilla/radicado', [App\Http\Controllers\TargetController::class, 'getRadicado'])->name('listaRadicado.radicado');
Route::get('ventanilla/radicadoPendiente', [App\Http\Controllers\TargetController::class, 'getRadicadoPendiente'])->name('listaRadicadoPendiente.radicado');

// radicado
Route::post('radicado/{radicado_id}', [App\Http\Controllers\NconformeController::class, 'updateRadicado'])->name('Radicado.update');

// Route::get('ventas/admin/invoice/{categoria}',[App\Http\Controllers\InvoiceController::class, 'sacaSub']);



