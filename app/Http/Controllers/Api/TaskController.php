<?php

namespace App\Http\Controllers\Api;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

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
            'due_date' => 'required|date',
            'file' => 'nullable|file|max:2048|mimes:pdf,jpg,png,doc,docx', // 2MB max
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('tasks', 'uploads');
        }

        $task = Task::create([
            'name' => $validated['name'],
            'due_date' => $validated['due_date'],
            'file_path' => $filePath,
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
            'status' => 'sometimes|in:pending,in_progress,completed',
            'file' => 'nullable|file|max:2048|mimes:pdf,jpg,png,doc,docx',
        ]);

        if ($request->hasFile('file')) {
            // Delete old file if exists
            if ($task->file_path) {
                Storage::disk('uploads')->delete($task->file_path);
                }

                $filePath = $request->file('file')->store('tasks', 'uploads');
                $validated['file_path'] = $filePath;
            }

        $task->update($validated);
        return response()->json($task);
    }

    public function uploadFile(Request $request, Task $task)
    {
        $request->validate([
            'file' => 'required|file|max:2048|mimes:pdf,jpg,png,doc,docx'
        ]);

        if ($task->file_path) {
            Storage::disk('uploads')->delete($task->file_path);
        }

        $path = $request->file('file')->store('tasks', 'uploads');

        $task->update(['file_path' => $path]);

        return response()->json([
            'message' => 'File uploaded successfully',
            'file_path' => $path
        ]);
    }

    public function downloadFile(Task $task)
    {
        if (!$task->file_path) {
            abort(404, 'No file attached to this task');
        }

        if (!Storage::disk('uploads')->exists($task->file_path)) {
            abort(404, 'File not found in storage');
        }

        return Storage::disk('uploads')->response($task->file_path);
    }

    public function deleteFile(Task $task)
    {
        try {
            if ($task->file_path) {
                // Delete the file from storage
                Storage::disk('uploads')->delete($task->file_path);

                // Update the task record
                $task->update(['file_path' => null]);
            }

            return response()->json([
                'message' => 'File deleted successfully',
                'task' => $task->fresh()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting file: ' . $e->getMessage()
            ], 500);
        }
    }
    // Delete task
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204);
    }
}
