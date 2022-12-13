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


// Route::get('ventas/admin/invoice/{categoria}',[App\Http\Controllers\InvoiceController::class, 'sacaSub']);
use App\Models\User;
Route::get('notificacion', function (){
    $user = User::find(1);
    $user->notify(new \App\Notifications\NconformeNotification);
    return 'Notificacion enviada';
});

