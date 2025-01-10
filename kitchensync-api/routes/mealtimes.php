<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealtimeController;

Route::get('/mealtimes', [MealtimeController::class, 'getall']);
Route::get('/mealtimes/{id}', [MealtimeController::class, 'getone']);