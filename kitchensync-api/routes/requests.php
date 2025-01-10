<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RequestController;

Route::get('/requests/{family_id}', [RequestController::class, 'getAllByFamily']);
Route::post('/requests', [RequestController::class, 'post']);
Route::put('/requests/{id}', [RequestController::class, 'put']);
Route::delete('/requests/{id}', [RequestController::class, 'delete']);