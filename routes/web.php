<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UsersController;
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

Route::middleware(['auth'])->group(function () {
    // ROUTE CLIENT
    Route::get('/clients', [ClientController::class, 'index'])->name('client.index');
    Route::get('/clients/tambah', [ClientController::class, 'tambahdata'])->name('client.tambahdata')->middleware('admin');
    Route::get('/clients/edit/{client}', [ClientController::class, 'editdata'])->name('client.editdata')->middleware('admin');

    Route::post('/clients/simpan', [ClientController::class, 'simpandata'])->name('client.simpandata')->middleware('admin');
    Route::put('/clients/update/{client}', [ClientController::class, 'updatedata'])->name('client.updatedata')->middleware('admin');
    Route::delete('/clients/delete/{client}', [ClientController::class, 'hapusdata'])->name('client.hapusdata')->middleware('admin');

    // ROUTE ORDER
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    Route::get('/orders/tambah', [OrderController::class, 'tambahdata'])->name('order.tambahdata')->middleware('admin');
    Route::get('/orders/edit/{order}', [OrderController::class, 'editdata'])->name('order.editdata')->middleware('admin');
    Route::get('/orders/unduh/pdf', [OrderController::class, 'downloadpdf'])->name('order.downloadpdf');

    Route::post('/orders/simpan', [OrderController::class, 'simpandata'])->name('order.simpandata')->middleware('admin');
    Route::put('/orders/update/{order}', [OrderController::class, 'updatedata'])->name('order.updatedata')->middleware('admin');
    Route::delete('/orders/delete/{order}', [OrderController::class, 'hapusdata'])->name('order.hapusdata')->middleware('admin');

    // ROUTE USERS
    Route::get('/users', [UsersController::class, 'index'])->name('user.index')->middleware('superadmin');
    Route::get('/users/edit/{user}', [UsersController::class, 'editdata'])->name('user.editdata')->middleware('superadmin');

    Route::put('/users/update/{user}', [UsersController::class, 'updatedata'])->name('user.updatedata')->middleware('superadmin');
});
