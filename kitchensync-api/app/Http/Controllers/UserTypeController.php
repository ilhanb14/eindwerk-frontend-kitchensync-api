<?php

namespace App\Http\Controllers;

use App\Models\UserType;
use Illuminate\Http\Request;

class UserTypeController extends Controller
{
    // Get all user types
    public function getall()
    {
        $usertypes = UserType::all();
        return response()->json($usertypes);
    }

    // Get user type by id
    public function getone($id)
    {
        $usertype = UserType::find($id);
        if (!$usertype) {
            return response()->json(['message' => 'User type not found'], 404);
        }

        return response()->json($usertype);
    }
}
