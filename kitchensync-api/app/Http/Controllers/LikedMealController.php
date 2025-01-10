<?php

namespace App\Http\Controllers;

use App\Models\LikedMeal;
use Illuminate\Http\Request;

class LikedMealController extends Controller
{
    // Get all liked meals by account_id
    public function getAllByAccountId($account_id)
    {
        $liked_meals = LikedMeal::where('account_id', $account_id)->get();
        return response()->json($liked_meals);
    }

    // Add a liked meal
    public function post(Request $request)
    {
        $liked_meal = LikedMeal::create($request->all());
        return response()->json(['message' => 'Meal liked successfully'], 201);
    }

    // Delete liked meal
    public function delete($id)
    {
        $liked_meal = LikedMeal::find($id);
        if (!$liked_meal) {
            return response()->json(['message' => 'Liked meal not found'], 404);
        }

        $liked_meal->delete();
        return response()->json(['message' => 'Liked meal deleted successfully']);
    }
}
