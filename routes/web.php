<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;


Route::get('/login', function () {
    return view('auth.login');
})->name("login");
Route::get('/register', function () {
    return view('auth.register');
})->name("register");


Route::post("/login", [AuthController::class, "login"])->name("loginUser");
Route::post("/register", [AuthController::class, "register"])->name("registerUser");
Route::get("/logout", [AuthController::class, "logout"]);

Route::get('/', function () {
    return view('welcome');
})->middleware("auth");
