<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StepController;
use App\Http\Controllers\Api\TaskController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('tasks', TaskController::class);

Route::prefix('steps')->group(function () {
    Route::get('/', [StepController::class, 'index']);       // Get all steps
    Route::post('/', [StepController::class, 'store']);      // Create step
    Route::put('/{step}', [StepController::class, 'update']); // Update step
    Route::delete('/{step}', [StepController::class, 'destroy']); // Delete step
});

// Steps endpoints
// routes/api.php
Route::apiResource('tasks.steps', StepController::class)->shallow();

Route::prefix('steps/{step}')->group(function () {
    Route::put('/', [StepController::class, 'update']);
    Route::delete('/', [StepController::class, 'destroy']);
});
