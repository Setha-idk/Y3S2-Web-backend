<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StepController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\API\ComplaintController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\TaskAssignmentController;
use App\Http\Controllers\Api\HistoryController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::apiResource('users', UserController::class);
Route::post('/tasks/{task}/file', [TaskController::class, 'uploadFile']);
Route::get('/tasks/{task}/file', [TaskController::class, 'downloadFile']);
Route::delete('/tasks/{task}/file', [TaskController::class, 'deleteFile']);
Route::put('/users/{id}', [UserController::class, 'update']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::middleware(['web'])->prefix('auth')->group(function () {
    Route::get('/me', function (Request $request) {
        return $request->user();
    })->middleware('auth:sanctum');
});

Route::apiResource('tasks', TaskController::class);

Route::prefix('steps')->group(function () {
    Route::get('/', [StepController::class, 'index']);       // Get all steps
    Route::post('/', [StepController::class, 'store']);      // Create step
    Route::put('/{step}', [StepController::class, 'update']); // Update step
    Route::delete('/{step}', [StepController::class, 'destroy']); // Delete step
});

Route::apiResource('complaints', ComplaintController::class);
// Steps endpoints
// routes/api.php
Route::apiResource('tasks.steps', StepController::class)->shallow();

Route::prefix('steps/{step}')->group(function () {
    Route::put('/', [StepController::class, 'update']);
    Route::delete('/', [StepController::class, 'destroy']);
});

// Task assignment endpoints
Route::apiResource('task-assignments', TaskAssignmentController::class);
Route::apiResource('history', HistoryController::class);
