<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CuisineController;

Route::get('/cuisines', [CuisineController::class, 'getAll']);