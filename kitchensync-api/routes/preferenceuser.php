<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreferenceUserController;

Route::get('/preferenceuser/{user_id}', [PreferenceUserController::class, 'getAll']);
Route::post('/preferenceuser', [PreferenceUserController::class, 'post']);
Route::put('/preferenceuser/{user_id}/{preference_id}', [PreferenceUserController::class, 'toggleImportant']);
Route::delete('/preferenceuser/{user_id}/{preference_id}', [PreferenceUserController::class, 'delete']);