<?php

use App\Http\Controllers\AsistenciaController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;
use App\Models\Asistencia;
use App\Http\Controllers\Auth\LoginController;

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

// Route::get('/', function () { return view('index');})->middleware('auth');;
Route::get('/', [App\Http\Controllers\AdminController::class,'index'])->name('index');
Route::get('/asistencias/reportes', [AsistenciaController::class, 'reportes'])->name('reportes');
Route::get('/asistencias/pdf', [AsistenciaController::class, 'pdf'])->name('pdf');
Route::get('/asistencias/pdf_fechas', [AsistenciaController::class, 'pdf_fechas'])->name('pdf_fechas');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes(['register'=>true]);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


// Route::get('/miembros', [App\Http\Controllers\MiembroController::class, 'index']);
// Route::get('/miembros/create', [App\Http\Controllers\MiembroController::class, 'create']);
Route::resource('/miembros', \App\Http\Controllers\MiembroController::class)->middleware('can:miembros');
Route::resource('/ministerios', \App\Http\Controllers\MinisterioController::class)->middleware('can:ministerios');
Route::resource('/usuarios', \App\Http\Controllers\UserController::class)->middleware('can:usuarios');
Route::resource('/asistencias', \App\Http\Controllers\AsistenciaController::class)->middleware('can:asistencias');
