<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\AccountPreference;
use App\Models\Preference;
use Illuminate\Http\Request;

class AccountPreferenceController extends Controller
{
    // Get all preferences by account_id
    public function getAll($account_id)
    {
        $account = Account::find($account_id);
    
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        $preferences = $account->preferences;
        return response()->json($preferences);
    }

    // Add preference to an account
    public function post(Request $request)
    {

        $validated = $request->validate([
            'account_id' => 'required|exists:accounts,id',
            'preference_id' => 'required|exists:preferences,id',
            'important' => 'sometimes|boolean'
        ]);

        $account = Account::find($validated['account_id']);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        $account->preferences()->attach($validated['preference_id'], [
            'important' => $request->input('important', true)
        ]);

        $preference = $account->preferences()->find($validated['preference_id']);

        return response()->json($preference, 201);
    }
    
    // Change importance of preference account
    public function toggleImportant($account_id, $preference_id)
    {
        // Find the account
        $account = Account::find($account_id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        //get the current pivot row for the specified preference
        $current = $account->preferences()
            ->wherePivot('preference_id', $preference_id)
            ->first();

        if (!$current) {
            return response()->json(['message' => 'Preference not found for this account'], 404);
        } 

        // Toggle the 'important' value
        $newImportant = !$current->pivot->important;
        
        // Update the pivot table
        $account->preferences()->updateExistingPivot($preference_id, [
            'important' => $newImportant,
        ]);
   
        return response()->json(['message' => 'Preference importance toggled successfully', 'important' => $newImportant], 200);
        
    }

    // Delete preference from account
    public function delete($account_id, $preference_id)
    {
        // Find the account
        $account = Account::find($account_id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        // Check if preference exists
        $exists = $account->preferences()->wherePivot('preference_id', $preference_id)->exists();

        if (!$exists) {
            return response()->json(['message' => 'Preference not found for this account'], 404);
        }

        // Detach the preference from the account
        $account->preferences()->detach($preference_id);
        
        return response()->json(['message' => 'Preference deleted successfully from account']);
    }
}
