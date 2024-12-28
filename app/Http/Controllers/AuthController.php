<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Handle an incoming authentication request.
    public function login(Request $request)
    {
        // Validate the incoming request data to ensure it meets the required criteria
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Create an array of credentials to be used for authentication
        $credentials = ['email' => $request->email, 'password' => $request->password];

        // Attempt to authenticate the user using the provided credentials
        if (Auth::attempt($credentials)) {
            // If authentication is successful, retrieve the authenticated user instance
            $user = Auth::user();

            // Generate a new API token for the authenticated user
            $token = $user->createToken('API Token')->plainTextToken;

            // Return a JSON response containing the authenticated user data and API token
            return response()->json([
                'user' => $user,
                'token' => $token,
            ]);
        }

        // If authentication fails, return a JSON response with an error message
        return response()->json(['error' => 'Unauthorized'], 401);
    }
}
