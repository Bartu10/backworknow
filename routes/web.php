<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/works', [WorkController::class, 'index']);
