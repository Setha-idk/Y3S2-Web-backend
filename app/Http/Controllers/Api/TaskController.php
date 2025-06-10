<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        return Task::orderBy('id')->get();
    }

    // Create new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task = Task::create($validated);

        return response()->json($task, 201);
    }

    // Get single task
    public function show(Task $task)
    {
        return $task;
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'description' => 'nullable|string',
        ]);

        $task->update($validated);
        return response()->json($task);
    }

    // Delete task
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }

    // Download attached file for a task
    public function downloadFile(Task $task)
    {
        if (!$task->file_path) {
            return response()->json(['message' => 'No file attached to this task.'], 404);
        }
        $filePath = storage_path('app/public/' . $task->file_path);
        if (!file_exists($filePath)) {
            return response()->json(['message' => 'File not found.'], 404);
        }
        return response()->download($filePath);
    }
}
