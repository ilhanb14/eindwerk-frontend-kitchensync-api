<?php

namespace App\Http\Controllers;

use App\Models\Preference;
use Illuminate\Http\Request;

class PreferenceController extends Controller {
    // Get all preferences
    public function getall()
    {
        $preferences = Preference::all();
        return response()->json($preferences);
    }

    // Get preference by id
    public function getone($id)
    {
        $preference = Preference::find($id);
        if (!$preference) {
            return response()->json(['message' => 'Preference not found'], 404);
        }

        return response()->json($preference);
    }
}