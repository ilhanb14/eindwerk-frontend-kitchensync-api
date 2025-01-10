<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

Route::get('/accounts', [AccountController::class, 'getAll']);
Route::get('/accounts/{id}', [AccountController::class, 'getOne']);
Route::post('/accounts', [AccountController::class, 'post']);
Route::put('/accounts/{id}', [AccountController::class, 'put']);
Route::delete('/accounts/{id}', [AccountController::class, 'delete']);