<?php

namespace App\Http\Controllers;

use http\Env\Response;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Carbon;
use App\Exceptions\ErrorManager;
class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            return Task::orderBy('created_at', 'DESC')->get();
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Error getting tasks'
            ], 403);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $newTask = new Task;
            $newTask->title = $request->task["title"];
            $newTask->description = $request->task["description"];
            $newTask->save();

            return $newTask;
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Error creating task->'.$e->getMessage()
            ], 403);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $existingTask = Task::find($id);

            if(!$existingTask){
                return response()->json([
                    'message' => 'Task not found'
                ], 404);
            }

            $existingTask->completed = $request->task['completed'] ? true : false;
            $existingTask->completed_at = $request->task['completed']? Carbon::now() : null;
            $existingTask->save();
            return $existingTask;

        }catch (Exception $e){
            return response()->json([
                'message' => 'Error updating task'
            ], 403);
        }
    }
    /**
     * Remove all tasks from storage.
     */

    public function destroyAll(Request $request){
        try {
            $tasks = Task::all();
            foreach($tasks as $task){
                $task->delete();
            }
            return \response()->json([
                'message' => 'All tasks deleted'
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting tasks'
            ], 403);
        }
    }


    /**
     * Remove the selected resource from storage.
     */
    public function destroySelectedTasks(Request $request){
        try {
            $selectedTasks = $request->selectedTasks;
            if(!$selectedTasks || count($selectedTasks) == 0){
                return \response()->json([
                    'message' => 'No tasks selected'
                ], 403);
            }
            foreach($selectedTasks as $id){
                $existingTask = Task::find($id);
                if(!$existingTask){
                    return "Task not found";
                }
                $existingTask->delete();
            }
            return \response()->json([
                'message' => 'Selected tasks deleted'
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting tasks'
            ], 403);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $existingTask = Task::find($id);
            if(!$existingTask){
                return response()->json([
                    'message' => 'Task not found'
                ], 404);

            }
            $existingTask->delete();
            return  response()->json([
                'message' => 'Task deleted'
            ], 200);
        }catch (Exception $e) {
            return response()->json([
                'message' => 'Error deleting task'
            ], 403);
        }
    }
}
