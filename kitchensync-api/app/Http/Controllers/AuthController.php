<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        // Find user by email
        $user = User::where('email', $email)->first();

        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }

        // Verify password
        if (Hash::check($password, $user->password)) {
            // Generate token
            $user->remember_token = Str::random(20);
            $user->save();        

            return response()->json([
                'message' => 'Login successful',
                'remember_token' => $user->remember_token, // Return token stored in database
                'user' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email
                ]
            ]);
        }

        return response()->json([
            'message' => 'Invalid credentials'
        ], 401);
    }

    public function verifyToken(Request $request)
    {
        $remember_token = $request->input('remember_token');

        // Check if token exists in database
        $user = User::where('remember_token', $remember_token)->first();

        if ($user) {
            return response()->json([
                'valid' => true,
                'user' => [
                    'name' => $user->name,
                    'email' => $user->email
                ]
            ]);
        }
            
        return response()->json([
            'valid' => false,
            'message' => 'Invalid token'
        ], 401);
        
    }

    public function register(Request $request)
    {
        $existingUser = User::where('email', $request->input('email'))->first();

        if ($existingUser) {
            return response()->json([
                'message' => 'Email already in use'
            ], 400);
        }

        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->remember_token = Str::random(20); // Generate random token
        $user->user_type_id = $request->input('user_type_id');
        $user->family_id = $request->input('family_id');
        

        try {
            $user->save();
            return response()->json([
                'message' => 'User registered successfully',
                'remember_token' => $user->remember_token,
                'user' => [
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email
                ]
            ]);
        } catch (\Exception $e) {
            \Log::error('Registration error: ' . $e->getMessage());

            return response()->json([
                'message' => 'Failed to register user',
                'error' => $e->getMessage() // Remove in production
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        $remember_token = $request->input('remember_token');

        // Find user by token
        $user = User::where('remember_token', $remember_token)->first();

        if ($user) {
            // Generate new token to invalidate old one
            $user->remember_token = Str::random(20);
            $user->save();

            return response()->json([
                'message' => 'Successfully logged out'
            ]);
        }

        return response()->json([
            'message' => 'Invalid token'
        ], 401);
    }
}