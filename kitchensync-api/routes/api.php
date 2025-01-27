<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventController;

require base_path('routes/users.php');

require base_path('routes/plannedmeals.php');

require base_path('routes/preferences.php');

require base_path('routes/preferenceuser.php');

require base_path('routes/likedmeals.php');

require base_path('routes/requests.php');

require base_path('routes/families.php');

require base_path('routes/usertypes.php');

require base_path('routes/mealtimes.php');

require base_path('routes/invitations.php');

require base_path('routes/cuisines.php');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-token', [AuthController::class, 'verifyToken']);
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::apiResource('events', EventController::class);