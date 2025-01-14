<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikedMealController;

Route::get('/likedmeals/{user_id}', [LikedMealController::class, 'getAllByUserId']);
Route::post('/likedmeals', [LikedMealController::class, 'post']);
Route::delete('/likedmeals/{id}', [LikedMealController::class, 'delete']);