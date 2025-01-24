<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {
    // Get all users
    public function getAll()
    {
        $users = User::all();
        return response()->json($users);
    }

    // Get user by id
    public function getOne($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json($user);
    }

    // Get users in family
    public function getByFamily($familyId)
    {
        $users = User::where('family_id', $familyId)
            ->with(['family', 'userType'])
            ->get();
        return response()->json($users);
    }

    // Add user
    public function post(Request $request)
    {
        $user = User::create($request->all());
        return response()->json(['message' => 'User created successfully'], 201);
    }
    
    // Update user
    public function put(Request $request, $id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->update($request->only(['first_name', 'last_name', 'family_id', 'email', 'user_type_id']));
        return response()->json(['message' => 'User updated successfully']);
    }

    // Delete user
    public function delete($id)
    {
        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }
}
