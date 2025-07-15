<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DeviceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DeviceUserController;

Route::get('/', function () {
    return view('welcome');
});
//AUTH CONTROLLER
Route::get('/auth/login', [AuthController::class, 'showLogin'])->name('auth.login');
Route::post('/auth/login', [AuthController::class, 'login'])->name('login');
Route::post('/dmv/index', [AuthController::class, 'logout'])->name('logout');

//DEVICE CONTROLLER
Route::get('/dmv/chart', [DeviceController::class, 'chart'])->name('dmv.chart');
Route::get('/dmv/export', [DeviceController::class, 'export'])->name('dmv.export');
Route::get('/dmv/index', [DeviceController::class, 'index'])->name('dmv.index');
Route::get('/dmv/devices', [DeviceController::class, 'indexUser'])->name('dmv.devices');
Route::get('/dmv/create', [DeviceController::class, 'create'])->name('dmv.create');
Route::get('/dmv/{id}', [DeviceController::class, 'show'])->name('dmv.show');
Route::get('/dmv/{id}/details', [DeviceController::class, 'show2'])->name('dmv.show2');
Route::get('/dmv/{id}/edit', [DeviceController::class, 'edit'])->name('dmv.edit');
Route::post('/dmv/{id}', [DeviceController::class, 'charge'])->name('dmv.charge');
Route::put('/dmv/{id}/update', [DeviceController::class, 'update'])->name('dmv.update');
Route::post('/dmv', [DeviceController::class, 'store'])->name('dmv.store');
Route::delete('/dmv/{id}', [DeviceController::class, 'destroy'])->name('dmv.destroy');


//DEVICE_USER
Route::post('/dmv/{did}/{uid}', [DeviceUserController::class, 'add'])->name('dmv.add');
Route::delete('/dmv/{did}/{uid}', [DeviceUserController::class, 'remove'])->name('dmv.remove');
