<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyController;

Route::get('/families/{id}', [FamilyController::class, 'getone']);
Route::post('/families', [FamilyController::class, 'post']);
Route::put('/families/{id}', [FamilyController::class, 'put']);
Route::delete('/families/{id}', [FamilyController::class, 'delete']);