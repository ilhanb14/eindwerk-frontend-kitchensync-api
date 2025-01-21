<?php

namespace App\Http\Controllers;

use App\Models\Family;
use Illuminate\Http\Request;

class FamilyController extends Controller
{
    // Get family by id
    public function getone($id)
    {
        $family = Family::find($id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        } else {
            return response()->json($family);
        }
    }

    // Add family
    public function post(Request $request)
    {
        $family = Family::create($request->all());
        return response()->json([
            'message' => 'Family created successfully',
            'family_id' => $family->id
        ], 201);
    }

    // Update family
    public function put(Request $request, $id)
    {
        $family = Family::find($id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }
        $family->update($request->only(['name']));
        return response()->json(['message' => 'Family updated successfully']);
    }

    // Delete family
    public function delete($id)
    {
        $family = Family::find($id);
        if (!$family) {
            return response()->json(['message' => 'Family not found'], 404);
        }
        $family->delete();
        return response()->json(['message' => 'Family deleted successfully']);
    }
}
