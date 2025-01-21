<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;

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


Route::post('/tasks', [TaskController::class, 'createTask']); 
Route::get('/tasks', [TaskController::class, 'getTask']);
Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask']);