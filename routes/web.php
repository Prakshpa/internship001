<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Session;

Route::get('/', function () {
    return view('welcome');
});
Route::view("login", "authenticate.login")->name('login');
Route::view("register", "authenticate.register")->name('register');
Route::get("users", [UserController::class, "users"])->name('users');
Route::post("register", RegisterController::class)->name('register.attempt');
Route::post("login", LoginController::class)
        ->middleware("throttle:5,1")
        ->name('login.attempt');
Route::view('dashboard', 'dashboard')
        ->middleware("auth")
        ->name('dashboard');
Route::post('logout',function(){
    Auth::guard('web')->logout();
    Session::invalidate();
    Session::regenerateToken();
    return redirect('../');
})->name('logout');