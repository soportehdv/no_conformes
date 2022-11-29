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
Route::get('user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user.create.vista');
Route::post('user/create', [App\Http\Controllers\UserController::class, 'createUser'])->name('user.create');
Route::get('user/update/{user_id}', [App\Http\Controllers\UserController::class, 'update'])->name('user.update.vista');
Route::post('user/update/{user_id}', [App\Http\Controllers\UserController::class, 'updateUser'])->name('user.update');
Route::get('user/list', [App\Http\Controllers\UserController::class, 'getUser'])->name('user.lista');

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

//tramite
Route::get('tramite/create/{Nconfome}', [App\Http\Controllers\NconformeController::class, 'createT'])->name('tramite.create.vista');
Route::post('tramite/create/{Nconfome}', [App\Http\Controllers\NconformeController::class, 'createTramite'])->name('tramite.create');

Route::get('markAsRead', function(){
    auth()->user()->unreadNotifications->markAsRead();
    return redirect()->back();
})->name('markAsRead');
Route::post('/mark-as-read', [App\Http\Controllers\NconformeController::class, 'markNotification'])->name('markNotification');

Route::get('targets/target', [App\Http\Controllers\TargetController::class, 'gettarget'])->name('listatarget.target');


// Route::get('ventas/admin/invoice/{categoria}',[App\Http\Controllers\InvoiceController::class, 'sacaSub']);
