<?php

namespace App\Http\Controllers\Api;

use App\Models\Step;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StepController extends Controller
{
    // Get all steps for a task
    public function index()
    {
        return Step::all();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'task_id' => 'required|exists:tasks,id',
            'description' => 'nullable|string',
            'status' => 'nullable|in:pending,completed',
        ]);

        return Step::create($validated);
    }

    public function update(Request $request, Step $step)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'status' => 'sometimes|in:pending,completed',
            'description' => 'nullable|string',
        ]);

        $step->update($validated);
        return $step;
    }

    public function destroy(Step $step)
    {
        $step->delete();
        return response()->noContent();
    }
}
