<?php

use App\Http\Controllers\AiController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/me', function (Request $request) {
    return $request->user();
});
Route::post('/login',[AuthController::class,'login']);

Route::apiResource('projects',ProjectController::class);

Route::apiResource('tasks',TaskController::class);

Route::apiResource('tags',TagController::class);

 Route::delete('/tasks/{task}/tags/{tag}',[TaskController::class,'delete']);

 Route::post('/tasks/{task}/tags',[TaskController::class,'insert']);

 Route::post('/register',[AuthController::class,'register']);

Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,'logout']);
Route::middleware('auth:sanctum')->get('/myprojects',[ProjectController::class,'index']);
Route::middleware(['auth:sanctum','ckeck_project'])->get('/myprojects/{project}',[ProjectController::class,'show']);

Route::post('/transcribe',[AiController::class,'transcribe']);
Route::post('/arabic',[AiController::class,'arabictransform']);