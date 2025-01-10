<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use Illuminate\Http\Request;

class AccountTypeController extends Controller
{
    // Get all account types
    public function getall()
    {
        $accounttypes = AccountType::all();
        return response()->json($accounttypes);
    }

    // Get account type by id
    public function getone($id)
    {
        $accounttype = AccountType::find($id);
        if (!$accounttype) {
            return response()->json(['message' => 'Account type not found'], 404);
        }

        return response()->json($accounttype);
    }
}
