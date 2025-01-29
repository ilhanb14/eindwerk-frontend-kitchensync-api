<?php

namespace App\Http\Controllers;

use App\Models\PlannedMeal;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PlannedMealController extends Controller {
    // Get all planned meals by family_id
    public function getAllByFamily($family_id)
    {
        $planned_meals = PlannedMeal::where('family_id', $family_id)->get();
        return response()->json($planned_meals);
    }

    // Get planned meals by family_id AND date
    public function getAllByFamilyAndDate($family_id, $date)
    {
        if (\Carbon\Carbon::hasFormat($date, 'Y-m-d')) {
            $parsedDate = \Carbon\Carbon::parse($date);
            $planned_meals = PlannedMeal::where('family_id', $family_id)
                                        ->where('date', $date)->get();
            return response()->json($planned_meals);
        } else {
            return response()->json(['message' => 'Invalid date format. Use YYYY-MM-DD.'], 400);
        }
    }

    // Add a planned meal
    public function post(Request $request)
    {
        $planned_meal = PlannedMeal::create($request->all());
        return response()->json([
            'message' => 'Meal planned successfully',
            'id' => $planned_meal->id
        ], 201);
    }

    // Update planned meal
    public function put(Request $request, $id)
    {
        $planned_meal = PlannedMeal::find($id);
        if (!$planned_meal) {
            return response()->json(['message' => 'Planned meal not found'], 404);
        } else {
            $planned_meal->update($request->only(['meal_id', 'date', 'mealtime_id', 'servings']));
            return response()->json(['message' => 'Planned meal updated successfully'], 200);
        }
    }

    // Delete planned meal
    public function delete($id)
    {
        $planned_meal = PlannedMeal::find($id);
        if (!$planned_meal) {
            return response()->json(['message' => 'Planned meal not found'], 404);
        }

        $planned_meal->delete();
        return response()->json(['message' => 'Planned meal deleted successfully']);
    }
}