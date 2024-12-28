<?php

namespace App\Http\Controllers;

use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    // Handle the country index request
    public function index()
    {
        // Retrieve all countries from the database
        $countries = Country::all();

        // Check if there are any countries
        if ($countries->isEmpty()) {
            // If no countries are found, return a 404 response with a message
            return response()->json(['message' => 'No countries found'], 404);
        }

        // If countries are found, return a successful response with the countries data
        return response()->json([
            'message' => 'Countries retrieved successfully',
            'data' => $countries
        ]);
    }

    // Handle country creation
    public function store(Request $request)
    {
        // Validate the incoming request data to ensure it meets the required criteria
        $validatedData = $request->validate([
            'name' => 'required|string|unique:countries',
        ]);

        // Create a new country instance using the validated request data
        $country = Country::create($validatedData);

        // Return a JSON response containing the newly created country data and a success message
        return response()->json([
            'message' => 'Country created successfully',
            'data' => $country
        ], 201);
    }

    // Display the specified country
    public function show(int $id)
    {
        // Attempt to find the country by the provided ID
        $country = Country::find($id);

        // Check if the country was found
        if (!$country) {
            // If the country was not found, return a 404 response with a message
            return response()->json(['message' => 'Country not found'], 404);
        }

        // If the country was found, return a successful response with the country data
        return response()->json([
            'message' => 'Country retrieved successfully',
            'data' => $country
        ]);
    }

    // Update a country.
    public function update(Request $request, $id)
    {
        // Validate the incoming request data to ensure it meets the required criteria
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:countries,name,' . $id,
        ]);

        // Attempt to find the country by the provided ID
        $country = Country::find($id);

        // Check if the country was found
        if (!$country) {
            // If the country was not found, return a 404 response with a message
            return response()->json(['message' => 'Country not found'], 404);
        }

        // Update the country with the validated data
        $country->update($validated);

        // Return a JSON response containing the updated country data and a success message
        return response()->json([
            'message' => 'Country updated successfully',
            'data' => $country
        ]);
    }

    // Delete a country by its ID.
    public function destroy(int $id)
    {
        // Attempt to find the country by the provided ID
        $country = Country::find($id);

        // Check if the country was found
        if (!$country) {
            // If the country was not found, return a 404 response with a message
            return response()->json(['message' => 'Country not found'], 404);
        }

        // Delete the country from the database
        $country->delete();

        // Return a JSON response containing the deleted country data and a success message
        return response()->json([
            'message' => 'Country deleted successfully',
            'data' => $country
        ]);
    }
}
