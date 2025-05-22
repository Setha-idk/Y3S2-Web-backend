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
        return Task::orderBy('due_date')->get();
    }

    // Create new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date'
        ]);

        $task = Task::create([
            ...$validated,
            'status' => 'pending'
        ]);

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
            'due_date' => 'sometimes|date',
            'status' => 'sometimes|in:pending,in_progress,completed'
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
}
