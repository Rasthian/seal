<?php

use App\Http\Controllers\AuthController;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/tasks', [TaskController::class, 'getTask']);
Route::get('/projects', [ProjectController::class, 'getProject']);

Route::middleware('auth:sanctum')->group(function () {
   
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/users/{id}', [AuthController::class, 'updateUser']);
    Route::delete('/users/{id}', [AuthController::class, 'deleteUser']);
    Route::get('/profile/{id}', [AuthController::class, 'getProfileById']);

    Route::post('/projects', [ProjectController::class, 'createProject']);
    Route::delete('/projects/{id}', [ProjectController::class, 'deleteProject']);
    Route::put('/projects/{id}', [ProjectController::class, 'updateProject']);


    Route::post('/tasks', [TaskController::class, 'createTask']);
    Route::delete('/tasks/{id}', [TaskController::class, 'deleteTask']);
    Route::put('/tasks/{id}', [TaskController::class, 'updateTask']);
});
