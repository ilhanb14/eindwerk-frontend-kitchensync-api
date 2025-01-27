<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/users', [UserController::class, 'getAll']);
Route::get('/users/{id}', [UserController::class, 'getOne']);
Route::get('/users/family/{familyId}', [UserController::class, 'getByFamily']);
Route::post('/users', [USerController::class, 'post']);
Route::put('/users/{id}', [USerController::class, 'put']);
Route::delete('/users/{id}', [UserController::class, 'delete']);