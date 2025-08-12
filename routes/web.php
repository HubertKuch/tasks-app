<?php

use App\Http\Controllers\LoginController;
use App\Livewire\LoginView;
use App\Livewire\MainView;
use App\Livewire\RegisterView;
use Illuminate\Support\Facades\Route;

Route::get('/', MainView::class);
Route::get('/login', LoginView::class);
Route::get('/register', RegisterView::class);

// auth
Route::post("/login", [LoginController::class, "authenticate"]);
