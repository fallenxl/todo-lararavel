<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| Rutas de la API
|--------------------------------------------------------------------------
|
| Aquí es donde puedes registrar las rutas de la API para tu aplicación.
| Estas rutas son cargadas por el proveedor de servicios y todas se asignarán
| al grupo de middleware "api". ¡Haz algo genial!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Grupo de rutas relacionadas con tareas
Route::prefix('/tasks')->group(function () {
    // Ruta para obtener todas las tareas
    Route::get('/', [TaskController::class, 'index']);
    // Ruta para eliminar todas las tareas
    Route::delete('/all', [TaskController::class, 'destroyAll']);
    // Ruta para eliminar tareas seleccionadas
    Route::delete('/selected', [TaskController::class, 'destroySelectedTasks']);
});

// Grupo de rutas relacionadas con tareas individuales
Route::prefix('/task')->group(function () {
    // Ruta para crear una nueva tarea
    Route::post('/store', [TaskController::class, 'store']);
    // Ruta para actualizar una tarea por su ID
    Route::put('/{id}', [TaskController::class, 'update']);
    // Ruta para eliminar una tarea por su ID
    Route::delete('/{id}', [TaskController::class, 'destroy']);
});
