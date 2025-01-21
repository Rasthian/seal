<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/hello', function () {
    return "Hello";
});
Route::post('/projects', [ProjectController::class, 'createProject']); 
Route::get('/projects', [ProjectController::class, 'getProject']);
Route::delete('/projects/{id}', [ProjectController::class, 'deleteProject']);
Route::put('/projects/{id}', [ProjectController::class, 'updateProject']);
