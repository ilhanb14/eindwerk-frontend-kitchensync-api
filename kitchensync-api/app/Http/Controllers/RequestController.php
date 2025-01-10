<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request as RequestBody; // Needed to rename this to avoid conflict
use App\Models\Request;

class RequestController extends Controller
{
    // Get all requests by family id
    public function getAllByFamily($family_id)
    {
        $requests = Request::where('family_id', $family_id)->get();
        return response()->json($requests);
    }

    // Add a request
    public function post(RequestBody $requestBody)
    {
        $request = Request::create($requestBody->all());
        return response()->json(['message' => 'Request created successfully'], 201);
    }

    // Update a request
    public function put(RequestBody $requestBody, $id)
    {
        $request = Request::find($id);
        if (!$request) {
            return response()->json(['message' => 'Request not found'], 404);
        }
        $request->update($requestBody->all());
        return response()->json(['message' => 'Request updated successfully']);
    }

    // Delete a request
    public function delete($id)
    {
        $request = Request::find($id);
        if (!$request) {
            return response()->json(['message' => 'Request not found'], 404);
        }
        $request->delete();
        return response()->json(['message' => 'Request deleted successfully']);
    }
}
