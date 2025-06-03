<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TaskAssignment;
use Illuminate\Http\Request;

class TaskAssignmentController extends Controller
{
    public function index()
    {
        return TaskAssignment::with(['task', 'employee', 'assigner'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'employee_id' => 'required|exists:users,id',
            'assigned_by' => 'required|exists:users,id',
            'due_date' => 'required|date',
            'status' => 'nullable|in:pending,in_progress,completed',
            'file_path' => 'nullable|string|max:255',
        ]);
        $assignment = TaskAssignment::create($validated);
        return response()->json($assignment->load(['task', 'employee', 'assigner']), 201);
    }

    public function update(Request $request, TaskAssignment $taskAssignment)
    {
        $validated = $request->validate([
            'task_id' => 'sometimes|exists:tasks,id',
            'employee_id' => 'sometimes|exists:users,id',
            'assigned_by' => 'sometimes|exists:users,id',
            'due_date' => 'sometimes|date',
            'status' => 'sometimes|in:pending,in_progress,completed',
            'file_path' => 'nullable|string|max:255',
        ]);
        $taskAssignment->update($validated);
        return response()->json($taskAssignment->load(['task', 'employee', 'assigner']), 200);
    }

    public function destroy(TaskAssignment $taskAssignment)
    {
        $taskAssignment->delete();
        return response()->json(['message' => 'Assignment deleted']);
    }
}
