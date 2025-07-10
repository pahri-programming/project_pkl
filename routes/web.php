<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\PembayaranController;
use App\Http\Controllers\Backend\KasmingguanController;
use App\Http\Controllers\Backend\TransaksikasController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Route Untuk Admin / backend
Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', Admin::class]], function () {
    Route::get('/', [BackendController::class, 'index']);
    Route::resource('/akun', UserController::class);
    Route::resource('/transaksi', TransaksikasController::class);
    Route::resource('/kasmingguan', KasmingguanController::class);
    Route::resource('/pembayaran', PembayaranController::class);

});
