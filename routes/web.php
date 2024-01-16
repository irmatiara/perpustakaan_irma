<?php

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

Auth::routes();

Route::middleware('auth')->group(function(){

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Dashboard
Route::get('/dashboard', [App\Http\Controllers\dashboard\DashboardController::class, 'index'])->name('dashboard');

//users
Route::get('/dashboard/users', [App\Http\Controllers\dashboard\UserController::class, 'index'])->name('dashboard');
Route::get('/dashboard/user/edit/{id}', [App\Http\Controllers\dashboard\UserController::class, 'edit'])->name('home');
Route::post('/dashboard/user/update/{id}', [App\Http\Controllers\dashboard\UserController::class, 'update'])->name('home');
Route::delete('/dashboard/user/delete/{id}', [App\Http\Controllers\dashboard\UserController::class, 'destroy'])->name('home');
});