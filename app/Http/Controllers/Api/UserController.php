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
            'password' => 'required|string|min:6', // Password is required
            'role'     => 'nullable|string|max:255', // Optional role field
            'department' => 'nullable|string|max:255', // Optional department field
            'access_level' => 'nullable|string|max:255', // Optional access level field
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        $profilePicturePath = null;
        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        }

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password), // Always hash password
            'role'     => $request->role, // Optional role field
            'department' => $request->department, // Optional department field
            'access_level' => $request->access_level, // Optional access level field
            'profile_picture' => $profilePicturePath,
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
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        if ($request->hasFile('profile_picture')) {
            $user->profile_picture = $request->file('profile_picture')->store('profile_pictures', 'public');
        }
        $user->name  = $request->name ?? $user->name;
        $user->email = $request->email ?? $user->email;
        $user->role  = $request->role ?? $user->role; // Update role if provided
        $user->department = $request->department ?? $user->department; // Update department if provided
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->access_level = $request->access_level ?? $user->access_level;
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
