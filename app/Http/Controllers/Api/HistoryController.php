<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\History;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    public function index()
    {
        return History::with('employee')->orderByDesc('action_time')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'action_time' => 'nullable|date',
            'user_name' => 'required|string|max:255',
            'email' => 'required|email',
            'name' => 'required|string|max:255',
            'employee_id' => 'required|exists:users,id',
            'action' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);
        $history = History::create($validated);
        return response()->json($history, 201);
    }

    public function show(History $history)
    {
        return $history->load('employee');
    }

    public function destroy(History $history)
    {
        $history->delete();
        return response()->json(null, 204);
    }
}
