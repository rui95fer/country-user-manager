<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Handle the user index request
    public function index()
    {
        // Retrieve all users from the database
        $users = User::all();

        // Check if there are any users
        if ($users->isEmpty()) {
            // If no users are found, return a 404 response with a message
            return response()->json(['message' => 'No users found'], 404);
        }

        // If users are found, return a successful response with the users data
        return response()->json([
            'message' => 'Users retrieved successfully',
            'data' => $users
        ]);
    }

    // Store a newly created user in storage
    public function store(Request $request)
    {
        // Validate the incoming request data to ensure it meets the required criteria
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
            'country_id' => 'nullable|exists:countries,id',
            'is_active' => 'boolean',
        ]);

        // Create a new user instance using the validated request data
        $newUser = User::create($validatedData);

        // Return a JSON response containing the newly created user data and a success message
        return response()->json([
            'message' => 'User created successfully',
            'data' => $newUser,
        ], 201);
    }

    // Display the specified user
    public function show(int $id)
    {
        // Attempt to find the user by the provided ID
        $user = User::find($id);

        // If the user is not found, return a 404 response with a message
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // If the user is found, return a successful response with the user data
        return response()->json([
            'message' => 'User retrieved successfully',
            'data' => $user
        ]);
    }

    // Update the specified user in storage
    public function update(Request $request, int $userId)
    {
        // Define the validation rules for the request data
        $validatedData = [
            'name' => 'string|max:255',
            'email' => 'email|unique:users,email,' . $userId,
            'is_active' => 'boolean',
            'country_id' => 'exists:countries,id',
        ];

        // Validate the request data using the defined rules
        $validatedData = $request->validate($validatedData);

        // Attempt to find the user by the provided ID
        $user = User::find($userId);

        // If the user is not found, return a 404 response with a message
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Update the user with the validated data
        $user->update($validatedData);

        // Return a successful response with the updated user data
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,
        ]);
    }

    // Handle the deletion of a user.
    public function destroy(int $id)
    {
        // Attempt to find the user by the provided ID
        $user = User::find($id);

        // If the user is not found, return a 404 response with a message
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Delete the user from the database
        $user->delete();

        // Return a successful response with the deleted user data
        return response()->json([
            'message' => 'User deleted successfully',
            'data' => $user
        ]);
    }
}
