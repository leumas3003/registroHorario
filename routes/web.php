<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\RegistroEmpleadoController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [EmpleadoController::class, 'getEmpleados'])->middleware(['auth'])->name('dashboard');
Route::get('/dashboard', [EmpleadoController::class, 'getEmpleados'])->middleware(['auth'])->name('dashboard');
Route::get('/listado',[EmpleadoController::class, 'accesoListaEmpleados'])->middleware(['auth'])->name('listado');
Route::post('/listado',[EmpleadoController::class, 'getListaEmpleados'])->middleware(['auth'])->name('listado');

Route::get('/nueva_empresa',[UserController::class, 'add'])->middleware(['auth']);
Route::post('/nueva_empresa',[UserController::class, 'save'])->middleware(['auth']);

Route::post('/borrar_empleado',[EmpleadoController::class, 'delete'])->middleware(['auth']);
Route::get('/nuevo_empleado',[EmpleadoController::class, 'add'])->middleware(['auth']);
Route::post('/nuevo_empleado',[EmpleadoController::class, 'save'])->middleware(['auth']);

Route::get('/empleado/{id}', [EmpleadoController::class, 'getEmpleado'])->middleware(['auth']);
Route::post('/empleado',[EmpleadoController::class, 'acceder'])->middleware(['auth']);

Route::get('/changepin/{id}',[EmpleadoController::class, 'accessChangePin'])->middleware(['auth']);
Route::post('/changepin',[EmpleadoController::class, 'changePin'])->middleware(['auth']);



Route::post('/registroEntrada',[RegistroEmpleadoController::class, 'registroEntrada'])->middleware(['auth']);
Route::post('/registroSalida',[RegistroEmpleadoController::class, 'registroSalida'])->middleware(['auth']);


require __DIR__.'/auth.php';
