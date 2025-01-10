<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikedMealController;

Route::get('/likedmeals/{account_id}', [LikedMealController::class, 'getAllByAccountId']);
Route::post('/likedmeals', [LikedMealController::class, 'post']);
Route::delete('/likedmeals/{id}', [LikedMealController::class, 'delete']);