<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Middleware\AuthMiddleware;
use App\Livewire\LoginView;
use App\Livewire\MainView;
use App\Livewire\RegisterSuccessView;
use App\Livewire\RegisterView;
use Illuminate\Support\Facades\Route;

Route::middleware([AuthMiddleware::class])->group(function () {
    Route::get('/', MainView::class);

    Route::get('/logout', [LoginController::class, 'logout']);
});

Route::get('/login', LoginView::class);
Route::get('/register', RegisterView::class);
Route::get("/register-success", RegisterSuccessView::class);

// auth
Route::post("/login", [LoginController::class, "authenticate"]);
Route::post("/register", [RegisterController::class, "register"]);

