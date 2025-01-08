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

