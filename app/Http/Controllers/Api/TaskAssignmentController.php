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
            'file_path' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,txt,csv,mp4,avi,mov,jpg,jpeg,png,gif|max:20480',
            'submitted_date' => 'nullable|date',
            'submitted_file_path' => 'nullable|string|max:255',
        ]);

        // Handle file upload for file_path
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            $path = $file->store('assignment_files', 'public');
            $validated['file_path'] = $path;
        }

        $assignment = TaskAssignment::create($validated);
        return response()->json($assignment->load(['task', 'employee', 'assigner']), 201);
    }

    public function update(Request $request, TaskAssignment $taskAssignment)
    {
        $validated = $request->validate([
            'status' => 'sometimes|in:pending,in_progress,completed',
            'submitted_date' => 'nullable|date',
        ]);

        // Handle file upload
        if ($request->hasFile('submitted_file_path')) {
            $file = $request->file('submitted_file_path');
            $path = $file->store('submitted_files', 'public');
            $taskAssignment->submitted_file_path = $path;
        }

        // Update other fields
        $taskAssignment->fill($validated);
        if ($request->has('status')) {
            $taskAssignment->status = $request->input('status');
        }
        if ($request->has('submitted_date')) {
            $taskAssignment->submitted_date = $request->input('submitted_date');
        }
        $taskAssignment->save();

        return response()->json($taskAssignment->load(['task', 'employee', 'assigner']));
    }

    public function destroy(TaskAssignment $taskAssignment)
    {
        $taskAssignment->delete();
        return response()->json(['message' => 'Assignment deleted']);
    }
}
