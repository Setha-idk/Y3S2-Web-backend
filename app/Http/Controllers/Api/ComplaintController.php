<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComplaintController extends Controller
{
    public function index()
    {
        return response()->json(Complaint::all(), 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'target_person_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $complaint = Complaint::create($request->all());
        return response()->json($complaint, 201);
    }

    public function show(Complaint $complaint)
    {
        return response()->json($complaint, 200);
    }

    public function update(Request $request, Complaint $complaint)
    {
        $validator = Validator::make($request->all(), [
            'type' => 'required|string|max:255',
            'subject' => 'required|string|max:255',
            'target_person_id' => 'required|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $complaint->update($request->all());
        return response()->json($complaint, 200);
    }

    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return response()->json(null, 204);
    }
}
