<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Get all accounts
Route::get('/accounts', function () {
    $accounts = DB::select('SELECT * FROM accounts');
    return response()->json($accounts);
});

// Get accounts by id
Route::get('/accounts/{id}', function ($id) {
    $account = DB::select('SELECT * FROM accounts WHERE id = ?', [$id]);
    if(empty($account)) {
        return response()->json(['message' => 'Account not found'], 404);
    } else {
        return response()->json($account[0]);
    }
});

// Add account
Route::post('/accounts', function (\Illuminate\Http\Request $request) {
    $first_name = $request->input('first_name');
    $last_name = $request->input('last_name');
    $family_id = $request->input('family_id');
    $email = $request->input('email');
    $account_type_id = $request->input('account_type_id');

    DB::insert('INSERT INTO accounts (first_name, last_name, family_id, email, account_type_id) VALUES (?, ?, ?, ?, ?)', [$first_name, $last_name, $family_id, $email, $account_type_id]);

    return response()->json(['message' => 'Account created successfully'], 201);
});

// Update account
Route::put('/accounts/{id}', function(\Illuminate\Http\Request $request, $id) {
    $first_name = $request->input('first_name');
    $last_name = $request->input('last_name');
    $email = $request->input('email');
    $account_type_id = $request->input('account_type_id');

    $affected = DB::update('UPDATE accounts SET first_name = ?, last_name = ?, email = ?, account_type_id = ? WHERE id = ?', [$first_name, $last_name, $email, $account_type_id, $id]);

    if($affected === 0) {
        return response()->json(['message' => 'Account not found or no changes made'], 404);
    } else {
        return response()->json(['message' => 'Account updated succesfully', 200]);
    }
});

// Delete account
Route::delete('/accounts/{id}', function($id) {
    $deleted = DB::delete('DELETE FROM accounts WHERE id = ?', [$id]);
    if ($deleted === 0) {
        return response()->json(['message' => 'Account not found'], 404);
    } else {
        return response()->json(['message' => 'Account deleted successfully', 200]);
    }
});