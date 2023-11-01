<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Carbon;
use Exception;

class TaskController extends Controller
{
    /**
     * Muestra una lista de recursos.
     */
    public function index()
    {
        try {
            // Consulta la base de datos para obtener todas las tareas ordenadas por la fecha de creación descendente.
            return Task::orderBy('created_at', 'DESC')->get();
        } catch (Exception $e) {
            // Si se produce una excepción durante la obtención de las tareas, se devuelve una respuesta de error con un mensaje.
            return response()->json([
                'message' => 'Error al obtener las tareas'
            ], 403); // Código de estado HTTP 403 indica un acceso no autorizado.
        }
    }

    /**
     * Almacena un nuevo recurso recién creado en el almacenamiento.
     */
    public function store(Request $request)
    {
        try {
            // Crea una nueva instancia de la tarea y asigna los valores del título y la descripción desde la solicitud.
            $newTask = new Task;
            $newTask->title = $request->task["title"];
            $newTask->description = $request->task["description"];
            $newTask->save(); // Guarda la tarea en la base de datos.

            return $newTask; // Devuelve la tarea recién creada.
        } catch (Exception $e) {
            // Si se produce una excepción durante la creación de la tarea, se devuelve una respuesta de error con un mensaje.
            return response()->json([
                'message' => 'Error al crear la tarea -> ' . $e->getMessage()
            ], 403);
        }
    }

    /**
     * Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, string $id)
    {
        try {
            // Busca la tarea existente en la base de datos por su ID.
            $existingTask = Task::find($id);

            if (!$existingTask) {
                // Si la tarea no se encuentra, devuelve una respuesta de error.
                return response()->json([
                    'message' => 'Tarea no encontrada'
                ], 404); // Código de estado HTTP 404 indica que el recurso no se encontró.
            }

            // Actualiza el estado de la tarea (completada o no) y la marca con la fecha actual si está completa.
            $existingTask->completed = $request->task['completed'] ? true : false;
            $existingTask->completed_at = $request->task['completed'] ? Carbon::now() : null;
            $existingTask->save(); // Guarda los cambios en la tarea.

            return $existingTask; // Devuelve la tarea actualizada.
        } catch (Exception $e) {
            // Si se produce una excepción durante la actualización de la tarea, se devuelve una respuesta de error con un mensaje.
            return response()->json([
                'message' => 'Error al actualizar la tarea'
            ], 403);
        }
    }

    /**
     * Elimina todas las tareas del almacenamiento.
     */
    public function destroyAll(Request $request)
    {
        try {
            // Obtiene todas las tareas.
            $tasks = Task::all();
            foreach ($tasks as $task) {
                $task->delete(); // Elimina cada tarea.
            }

            return \response()->json([
                'message' => 'Todas las tareas han sido eliminadas'
            ], 200); // Código de estado HTTP 200 indica una respuesta exitosa.
        } catch (Exception $e) {
            // Si se produce una excepción durante la eliminación de las tareas, se devuelve una respuesta de error con un mensaje.
            return response()->json([
                'message' => 'Error al eliminar las tareas'
            ], 403);
        }
    }

    /**
     * Elimina los recursos seleccionados del almacenamiento.
     */
    public function destroySelectedTasks(Request $request)
    {
        try {
            // Obtiene las ID de las tareas seleccionadas desde la solicitud.
            $selectedTasks = $request->selectedTasks;
            if (!$selectedTasks || count($selectedTasks) == 0) {
                // Si no se han seleccionado tareas, devuelve una respuesta de error.
                return \response()->json([
                    'message' => 'No se han seleccionado tareas'
                ], 403);
            }

            foreach ($selectedTasks as $id) {
                // Elimina cada tarea seleccionada por su ID.
                $existingTask = Task::find($id);
                if (!$existingTask) {
                    return "Tarea no encontrada";
                }
                $existingTask->delete();
            }

            return \response()->json([
                'message' => 'Tareas seleccionadas eliminadas'
            ], 200);
        } catch (Exception $e) {
            // Si se produce una excepción durante la eliminación de las tareas, se devuelve una respuesta de error con un mensaje.
            return response()->json([
                'message' => 'Error al eliminar las tareas'
            ], 403);
        }
    }

    /**
     * Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(string $id)
    {
        try {
            // Busca la tarea existente en la base de datos por su ID.
            $existingTask = Task::find($id);
            if (!$existingTask) {
                // Si la tarea no se encuentra, devuelve una respuesta de error.
                return response()->json([
                    'message' => 'Tarea no encontrada'
                ], 404); // Código de estado HTTP 404 indica que el recurso no se encontró.
            }
            $existingTask->delete(); // Elimina la tarea.

            return  response()->json([
                'message' => 'Tarea eliminada'
            ], 200); // Código de estado HTTP 200 indica una respuesta exitosa.
        } catch (Exception $e) {
            // Si se produce una excepción durante la eliminación de la tarea, se devuelve una respuesta de error con un mensaje.
            return response()->json([
                'message' => 'Error al eliminar la tarea'
            ], 403);
        }
    }
}
