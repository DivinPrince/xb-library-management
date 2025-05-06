<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\ReportsController;
use Illuminate\Support\Facades\Route;


Route::resource("books", BooksController::class)->middleware("auth");
Route::get("/books/{id}/borrow", [BooksController::class, "borrow"])->middleware("auth")->name("books.borrow");
Route::post("/books/{id}/borrow", [BooksController::class, "borrowBook"])->middleware("auth")->name("books.borrowBook");
Route::post("/books/return/{id}", [BooksController::class, "returnBook"])->middleware("auth")->name("books.return");

// Reports routes
Route::prefix('reports')->middleware('auth')->group(function () {
    Route::get('/', [ReportsController::class, 'index'])->name('reports.index');
    Route::get('/borrow-history', [ReportsController::class, 'borrowHistory'])->name('reports.borrow-history');
    Route::get('/user-activity', [ReportsController::class, 'userActivity'])->name('reports.user-activity');
    Route::get('/popular-books', [ReportsController::class, 'popularBooks'])->name('reports.popular-books');
});

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
