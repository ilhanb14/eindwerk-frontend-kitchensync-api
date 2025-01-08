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