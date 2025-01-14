<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserTypeController;

Route::get('/usertypes', [UserTypeController::class, 'getall']);
Route::get('/usertypes/{id}', [UserTypeController::class, 'getone']);