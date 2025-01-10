<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;

class AccountController extends Controller {
    // Get all accounts
    public function getAll()
    {
        $accounts = Account::all();
        return response()->json($accounts);
    }

    // Get account by id
    public function getOne($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        return response()->json($account);
    }

    // Add account
    public function post(Request $request)
    {
        $account = Account::create($request->all());
        return response()->json(['message' => 'Account created successfully'], 201);
    }
    
    // Update account
    public function put(Request $request, $id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        $account->update($request->only(['first_name', 'last_name', 'family_id', 'email', 'account_type_id']));
        return response()->json(['message' => 'Account updated successfully']);
    }

    // Delete account
    public function delete($id)
    {
        $account = Account::find($id);
        if (!$account) {
            return response()->json(['message' => 'Account not found'], 404);
        }

        $account->delete();
        return response()->json(['message' => 'Account deleted successfully']);
    }
}
