<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TaskController;
use App\Models\Tag;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('projects',ProjectController::class);

Route::apiResource('tasks',TaskController::class);

Route::apiResource('tags',TagController::class);

 Route::delete('/tasks/{task}/tags/{tag}',[TaskController::class,'delete']);

 Route::post('/tasks/{task}/tags',[TaskController::class,'insert']);

