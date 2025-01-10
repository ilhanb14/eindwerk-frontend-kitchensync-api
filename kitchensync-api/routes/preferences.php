<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreferenceController;

Route::get('/preferences', [PreferenceController::class, 'getAll']);
Route::get('/preferences/{id}', [PreferenceController::class, 'getOne']);
