<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller {
    // Get all accounts
    public function index()
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }

    // Update account
    public function update(Request $request, $id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        $account->update($request->only(['first_name', 'last_name', 'family_id', 'email', 'account_type_id']));
        return response()->json(['message' => 'Account updated successfully']);
    }

    // Delete account
    public function destroy($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        $account->delete();
        return response()->json(['message' => 'Account deleted successfully']);
    }

}
