<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
Route::get('/', function () {
    return view('welcome');
});
Route::get('/projects', [ProjectController::class, 'getProject']);