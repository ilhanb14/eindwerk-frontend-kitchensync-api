<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountTypeController;

Route::get('/accounttypes', [AccountTypeController::class, 'getall']);
Route::get('/accounttypes/{id}', [AccountTypeController::class, 'getone']);