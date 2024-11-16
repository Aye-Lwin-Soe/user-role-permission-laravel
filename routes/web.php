<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

//
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');
//Route::middleware(['auth', 'role.permission:Role'])->group(function () {
Route::middleware(['auth', 'feature:Role'])->group(function () {
    Route::resource('/roles', RoleController::class);
});
Route::namespace('App\Http\Controllers')->group(function () {
    Route::resource('/users', 'UserController')->middleware(['auth', 'feature:User']);
});
//});
