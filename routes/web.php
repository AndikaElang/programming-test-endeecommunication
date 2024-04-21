<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\SessionController;

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

// ROUTE SESSION
Route::get('/', [SessionController::class, 'login'])->name('login');
Route::get('/logout', [SessionController::class, 'actionlogout'])->name('actionlogout');
Route::get('/register', [SessionController::class, 'register'])->name('register');

Route::post('/login', [SessionController::class, 'actionlogin'])->name('actionlogin');
Route::post('/create', [SessionController::class, 'create'])->name('actionregister');

// ROUTE CLIENT
Route::get('/client', [ClientController::class, 'index'])->name('client.index');
Route::get('/clients/tambah', [ClientController::class, 'tambahdata'])->name('client.tambahdata');
Route::get('/clients/edit/{client}', [ClientController::class, 'editdata'])->name('client.editdata');

Route::post('/clients/simpan', [ClientController::class, 'simpandata'])->name('client.simpandata');
Route::put('/clients/update/{client}', [ClientController::class, 'updatedata'])->name('client.updatedata');
Route::delete('/clients/delete/{client}', [ClientController::class, 'hapusdata'])->name('client.hapusdata');

// ROUTE ORDER
Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
Route::get('/orders/tambah', [OrderController::class, 'tambahdata'])->name('order.tambahdata');
Route::get('/orders/edit/{order}', [OrderController::class, 'editdata'])->name('order.editdata');
Route::get('/orders/unduh/pdf', [OrderController::class, 'downloadpdf'])->name('order.downloadpdf');

Route::post('/orders/simpan', [OrderController::class, 'simpandata'])->name('order.simpandata');
Route::put('/orders/update/{order}', [OrderController::class, 'updatedata'])->name('order.updatedata');
Route::delete('/orders/delete/{order}', [OrderController::class, 'hapusdata'])->name('order.hapusdata');
