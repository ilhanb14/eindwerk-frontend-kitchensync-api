<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cuisine;

class CuisineController extends Controller
{
    function getAll() {
        $cuisines = Cuisine::all();
        return response()->json($cuisines);
    }
}
