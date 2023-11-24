<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangTransferController;
use App\Http\Controllers\UserController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/profile', 'ProfileController@index')->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::middleware('auth')->group(function() {
    Route::resource('user', UserController::class);
    Route::get('/barang-transfer/masuk', [BarangTransferController::class, 'barangsMasuk'])->name('barang-transfer.masuk');
    Route::get('/barang-transfer/keluar', [BarangTransferController::class, 'barangsKeluar'])->name('barang-transfer.keluar');
    Route::resource('barang-transfer', BarangTransferController::class)->names('barang-transfer');
    Route::resource('barang', BarangController::class)->names('barang');
});
