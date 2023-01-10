<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\UserController;

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

Route::get('/login', [LoginController::class, 'index'])->name('login.index');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');
Route::post('/login-submit', [LoginController::class, 'login'])->name('login.submit');
Route::get('/register', [RegisterController::class, 'index'])->name('register.index');
Route::post('/register-submit', [RegisterController::class, 'register'])->name('register.submit');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/users', [UserController::class, 'getUsers'])->name('user.list');
    Route::get('/users/remove/{user}', [UserController::class, 'remove'])->name('user.remove');
});
