<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangReportController;
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

    Route::resource('barang', BarangController::class)->names('barang');
    Route::get('/barang/{barang}/json', [BarangController::class, 'showJson'])->name('barang.show.json');
    Route::get('/reports/stok-barang', [BarangReportController::class, 'download_report_stok_barang'])->name('reports.stok-barang');

    Route::get('/barang-transfer/masuk', [BarangTransferController::class, 'barangsMasuk'])->name('barang-transfer.index.masuk');
    Route::get('/barang-transfer/keluar', [BarangTransferController::class, 'barangsKeluar'])->name('barang-transfer.index.keluar');
    Route::resource('barang-transfer', BarangTransferController::class)->names('barang-transfer');
    Route::get('/reports/barang-masuk', [BarangReportController::class, 'download_report_barang_masuk'])->name('reports.barang-masuk');
    Route::get('/reports/barang-keluar', [BarangReportController::class, 'download_report_barang_keluar'])->name('reports.barang-keluar');

});

Route::fallback(function () {
    return redirect()->route('home');
});
