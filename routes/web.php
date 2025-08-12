<?php

use App\Livewire\CreatePost;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('components.layouts.app');
});
