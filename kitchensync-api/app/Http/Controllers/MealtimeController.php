<?php

namespace App\Http\Controllers;

use App\Models\MealTime;
use Illuminate\Http\Request;

class MealtimeController extends Controller
{
    // Get all mealtimes
    public function getall()
    {
        $mealtimes = MealTime::all();
        return response()->json($mealtimes);
    }

    // Get mealtime by id
    public function getone($id)
    {
        $mealtimes = MealTime::find($id);
        return response()->json($mealtimes);
    }
}
