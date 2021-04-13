<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\MahasiswaController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('mahasiswa', MahasiswaController::class);
Route::get('mahasiswa/nilai/{nim}', [MahasiswaController::class, 'show_khs'])->name('mahasiswa.khs');
Route::get('mahasiswa/nilai{nim}/cetak_khs', [MahasiswaController::class, 'cetak_khs'])->name('mahasiswa.khs.cetak');

Route::get('artikel/cetak_pdf', [ArtikelController::class, 'cetak_pdf'])->name('artikel.cetak_pdf');
Route::resource('artikel', ArtikelController::class);
