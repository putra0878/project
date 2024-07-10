<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\AdminController;

Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::post('/customer/store', [CustomerController::class, 'store'])->name('customer.store');
Route::get('/customer/waiting/{id}', [CustomerController::class, 'waiting'])->name('customer.waiting');
Route::get('/customer/status/{id}', [CustomerController::class, 'status'])->name('customer.status');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::patch('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');
Route::get('/admin/{id}', [AdminController::class, 'show'])->name('admin.show');
Route::patch('/admin/approve/{id}', [AdminController::class, 'approve'])->name('admin.approve');


Route::get('/', function () {
    return view('welcome');
});
