<?php

use App\Livewire\LoginView;
use App\Livewire\MainView;
use Illuminate\Support\Facades\Route;

Route::get('/', MainView::class);
Route::get('/login', LoginView::class);
