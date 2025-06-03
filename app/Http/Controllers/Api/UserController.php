<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return response()->json(User::all());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'nullable|string|max:255', // Optional role field
            'department' => 'nullable|string|max:255', // Optional department field
            'access_level' => 'nullable|string|max:255', // Optional access level field
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role, // Optional role field
            'department' => $request->department, // Optional department field
            'access_level' => $request->access_level, // Optional access level field
        ]);

        return response()->json($user, 201);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => 'sometimes|required|string|max:255',
            'email'    => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6',
            'role'     => 'sometimes|string|max:255', // Optional role field
            'department' => 'sometimes|string|max:255', // Optional department field
            'access_level' => 'sometimes|string|max:255', // Optional access level field
        ]);

        $user->name  = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->role  = $request->role ?? $user->role; // Update role if provided
        $user->department = $request->department ?? $user->department; // Update department if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully.']);
    }


}
