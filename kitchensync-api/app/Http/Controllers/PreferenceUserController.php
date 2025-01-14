<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\PreferenceUser;
use App\Models\Preference;
use Illuminate\Http\Request;

class PreferenceUserController extends Controller
{
    // Get all preferences by user_id
    public function getAll($user_id)
    {
        $user = User::find($user_id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $preferences = $user->preferences;
        return response()->json($preferences);
    }

    // Add preference to an user
    public function post(Request $request)
    {

        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'preference_id' => 'required|exists:preferences,id',
            'important' => 'sometimes|boolean'
        ]);

        $user = User::find($validated['user_id']);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        $user->preferences()->attach($validated['preference_id'], [
            'important' => $request->input('important', true)
        ]);

        $preference = $user->preferences()->find($validated['preference_id']);

        return response()->json($preference, 201);
    }
    
    // Change importance of preference user
    public function toggleImportant($user_id, $preference_id)
    {
        // Find the user
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        //get the current pivot row for the specified preference
        $current = $user->preferences()
            ->wherePivot('preference_id', $preference_id)
            ->first();

        if (!$current) {
            return response()->json(['message' => 'Preference not found for this user'], 404);
        } 

        // Toggle the 'important' value
        $newImportant = !$current->pivot->important;
        
        // Update the pivot table
        $user->preferences()->updateExistingPivot($preference_id, [
            'important' => $newImportant,
        ]);
   
        return response()->json(['message' => 'Preference importance toggled successfully', 'important' => $newImportant], 200);
        
    }

    // Delete preference from user
    public function delete($user_id, $preference_id)
    {
        // Find the user
        $user = User::find($user_id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Check if preference exists
        $exists = $user->preferences()->wherePivot('preference_id', $preference_id)->exists();

        if (!$exists) {
            return response()->json(['message' => 'Preference not found for this user'], 404);
        }

        // Detach the preference from the user
        $user->preferences()->detach($preference_id);
        
        return response()->json(['message' => 'Preference deleted successfully from user']);
    }
}
