<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PpiuController;
use App\Http\Controllers\PengawasanController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\PanduanController;

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

Route::get('/', [LoginController::class, 'index'])->middleware('guest');
Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest');
Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/profil', [ProfilController::class, 'index'])->middleware('auth');
Route::get('/profil/update', [ProfilController::class, 'edit'])->middleware('auth');
Route::post('/profil/update', [ProfilController::class, 'update'])->middleware('auth');
Route::get('/profil/gantipassword', [ProfilController::class, 'gantipassword'])->middleware('auth');
Route::post('/profil/gantipassword', [ProfilController::class, 'savegantipassword'])->middleware('auth');
Route::get('/profil/akreditasi', [ProfilController::class, 'akreditasi'])->middleware('auth');
Route::post('/profil/akreditasi', [ProfilController::class, 'storeakreditasi'])->middleware('auth');

Route::get('/ppiu', [PpiuController::class, 'index'])->middleware('auth');
Route::get('/ppiu/create', [PpiuController::class, 'create'])->middleware('auth');
Route::post('/ppiu/create', [PpiuController::class, 'store'])->middleware('auth');
Route::get('/ppiu/update/{ppiu}', [PpiuController::class, 'edit'])->middleware('auth');
Route::post('/ppiu/update/{ppiu}', [PpiuController::class, 'update'])->middleware('auth');
Route::post('/ppiu/resetPassword/{ppiu}', [PpiuController::class, 'resetPassword'])->middleware('auth');
Route::post('/ppiu/delete/{ppiu}', [PpiuController::class, 'destroy'])->middleware('auth');
Route::post('/ppiu/find', [PpiuController::class, 'cariPpiu'])->name('cariPpiu')->middleware('auth');

Route::get('/pengawasan', [PengawasanController::class, 'index'])->middleware('auth');
Route::get('/pengawasan/create', [PengawasanController::class, 'create'])->middleware('auth');
Route::post('/pengawasan/create', [PengawasanController::class, 'store'])->middleware('auth');
Route::get('/pengawasan/detail/{pengawasan}', [PengawasanController::class, 'show'])->middleware('auth');
Route::get('/pengawasan/update/{pengawasan}', [PengawasanController::class, 'edit'])->middleware('auth');
Route::post('/pengawasan/update/{pengawasan}', [PengawasanController::class, 'update'])->middleware('auth');
Route::post('/pengawasan/delete/{pengawasan}', [PengawasanController::class, 'destroy'])->middleware('auth');
Route::post('/pengawasan/export', [PengawasanController::class, 'export'])->middleware('auth');

Route::get('/panduan', [PanduanController::class, 'index'])->middleware('auth');
