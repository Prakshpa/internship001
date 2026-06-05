<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});
Route::get("/login", function(){
    return view("authenticate.login");
});
Route::get("/register", function(){
    return view("authenticate.register");
});
Route::get("users", [UserController::class, "users"]);
Route::post("join", [UserController::class, "register"]);
Route::post("in", [UserController::class, "login"]);