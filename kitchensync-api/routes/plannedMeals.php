<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlannedMealController;

Route::get('/plannedmeals/{family_id}', [PlannedMealController::class, 'getAllByFamily']);
Route::get('/plannedmeals/{family_id}/{date}', [PlannedMealController::class, 'getAllByFamilyAndDate']);
Route::post('/plannedmeals', [PlannedMealController::class, 'post']);
