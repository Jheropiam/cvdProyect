<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DocumentosController;


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
    return redirect()->route('verifica.cvd');
});

Route::get('/verifica-cvd', [LoginController::class,'index'])->middleware(['auth'])->name('verifica.cvd');

Route::get('/login',function(){
    return view('usuarios.login');
})->name('login')->middleware('guest');

Route::get('/home',function(){
    return view('plantillas.home');
})->middleware('auth')->name('home');


Route::get('/usuarios/login', [LoginController::class,'usuariologin'])->middleware(['auth'])->name('usuarios.login');

Route::get('fill-data-pdf', [DocumentosController::class,'index']);



//Documentos
Route::get('/documentos/create', [DocumentosController::class,'create'])->middleware(['auth'])->name('documentos.create');
Route::post('/documentos/store', [DocumentosController::class,'store'])->middleware(['auth'])->name('documentos.store');
Route::get('/documentos/index', [DocumentosController::class,'index'])->middleware(['auth'])->name('documentos.index');
Route::post('/verifica-cvd', [DocumentosController::class,'show'])->middleware(['auth'])->name('documentos.show');
//Usuarios
Route::get('/usuarios/index', [UserController::class,'index'])->middleware(['auth'])->name('usuarios.index');
Route::get('/usuarios/edit/{id}', [UserController::class,'edit'])->middleware(['auth'])->name('usuarios.edit');
Route::post('/usuarios/update', [UserController::class,'update'])->middleware(['auth'])->name('usuarios.update');
Route::get('/usuarios/create', [UserController::class,'create'])->middleware(['auth'])->name('usuarios.create');
Route::post('/usuarios/store', [UserController::class,'store'])->middleware(['auth'])->name('usuarios.store');

Route::get("/verificanombre/{name}",[UserController::class,'verificanombre'])->middleware(['auth'])->name('verificanombre');
Route::get("/verificaemail/{email}",[UserController::class,'verificaemail'])->middleware(['auth'])->name('verificaemail');
Route::post("/ActualizaContrasena",[UserController::class, "ActualizaContrasena"])->middleware(['auth'])->name('Actualiza.Contrasena');


//Login
Route::post("/login",[LoginController::class, 'login']);
Route::put('/login', [LoginController::class, 'logout']);
