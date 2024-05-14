<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // return view('welcome');
    return redirect('/login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::post('/verificar', [App\Http\Controllers\HomeController::class, 'verificar'])->name('verificarOTP');
    Route::get('/reenviar', [App\Http\Controllers\HomeController::class, 'reenviar'])->name('reenviarOTP');

    // RUTAS PARA NEGOCIOS
    Route::get('/negocios', [App\Http\Controllers\NegociosController::class, 'index']);
    Route::get('/negocios/registrar', [App\Http\Controllers\NegociosController::class, 'create']);
    Route::post('/negocios/registrar', [App\Http\Controllers\NegociosController::class, 'store']);
    Route::get('/negocios/actualizar/{id}', [App\Http\Controllers\NegociosController::class, 'edit']);
    Route::put('/negocios/actualizar/{id}', [App\Http\Controllers\NegociosController::class, 'update']);
    Route::get('/negocios/estado/{id}', [App\Http\Controllers\NegociosController::class, 'estado']);
    Route::get('/negocios/ver/{id}', [App\Http\Controllers\NegociosController::class, 'show']);

    // RUTAS PARA PRODUCTOS
    Route::get('/productos', [App\Http\Controllers\ProductosController::class, 'index']);
    Route::get('/productos/registrar', [App\Http\Controllers\ProductosController::class, 'create']);
    Route::post('/productos/registrar', [App\Http\Controllers\ProductosController::class, 'store']);
    Route::get('/productos/actualizar/{id}', [App\Http\Controllers\ProductosController::class, 'edit']);
    Route::put('/productos/actualizar/{id}', [App\Http\Controllers\ProductosController::class, 'update']);
    Route::get('/productos/estado/{id}', [App\Http\Controllers\ProductosController::class, 'estado']);

    // RUTAS PARA PEDIDOS
    Route::get('/pedidos', [App\Http\Controllers\PedidosController::class, 'index']);
    Route::get('/pedidos/registrar', [App\Http\Controllers\PedidosController::class, 'create']);
    Route::put('/pedidos/estado/{id}', [App\Http\Controllers\PedidosController::class, 'cambiarEstado']);
    Route::get('/pedidos/ver/{id}', [App\Http\Controllers\PedidosController::class, 'show']);
});




