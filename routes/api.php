<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
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

Route::prefix('/tasks')->group( function (){
    Route::get('/', [TaskController::class, 'index']);
    Route::delete('/completed', [TaskController::class, 'destroyAllCompleted']);
    Route::delete('/all', [TaskController::class, 'destroyAll']);
    Route::delete('/selected', [TaskController::class, 'destroySelectedTasks']);
});
Route::prefix('/task')->group( function (){
    Route::post('/store', [TaskController::class, 'store']);
    Route::put('/{id}', [TaskController::class, 'update']);
    Route::delete('/{id}', [TaskController::class, 'destroy']);
});
