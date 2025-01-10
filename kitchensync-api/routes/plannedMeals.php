<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;

// Get all planned meals by family_id
Route::get('/plannedmeals/{family_id}', function($family_id) {
    $planned_meals = DB::select('SELECT * FROM plannedmeals WHERE family_id = ?', [$family_id]);
    return response()->json($planned_meals);
});

// Get planned meals by family_id and date
Route::get('plannedmeals/{family_id}/{date}', function ($family_id, $date) {
    if (\Carbon\Carbon::hasFormat($date, 'Y-m-d')) {
        $parsedDate = \Carbon\Carbon::parse($date);
        $planned_meals = DB::select('SELECT * FROM plannedmeals WHERE family_id = ? AND date = ?', [$family_id, $date]);
        return response()->json($planned_meals);
    } else {
        return response()->json(['message' => 'Invalid date format. Use YYYY-MM-DD.'], 400);
    }
});