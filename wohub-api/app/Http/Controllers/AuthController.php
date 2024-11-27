<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Find the user by email
        $user = Usuario::where('email', $request->email)->first();

        // Check if the user exists and if the password matches
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        // Create an access token for the user
        $token = $user->createToken('access_token')->plainTextToken;

        // Store the user ID (integer) in the session
        session(['user_id' => $user->id]); // This stores the user ID, not the email

        // Return the access token in the response
        return response()->json([
            'access_token' => $token,
        ]);
    }

    public
    function logout(Request $request)
    {
        $request->user()->tokens()->delete();

        return response()->json(['message' => 'Logged out successfully']);
    }
}
