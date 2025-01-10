<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PreferenceController;

Route::get('/preferences', [PreferenceController::class, 'getall']);
Route::get('/preferences/{id}', [PreferenceController::class, 'getone']);
