<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountPreferenceController;

Route::get('/accountpreference/{account_id}', [AccountPreferenceController::class, 'getAll']);
Route::post('/accountpreference', [AccountPreferenceController::class, 'post']);
Route::put('/accountpreference/{account_id}/{preference_id}', [AccountPreferenceController::class, 'toggleImportant']);
Route::delete('/accountpreference/{account_id}/{preference_id}', [AccountPreferenceController::class, 'delete']);