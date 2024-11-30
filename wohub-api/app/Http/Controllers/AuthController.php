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
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = Usuario::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = $user->createToken('access_token')->plainTextToken;

        session(['user_id' => $user->id]);

        return response()->json([
            'user' => $user,
            'access_token' => $token,
        ]);
    }


    public function logout(Request $request)
    {
        // Get the authenticated user
        $user = $request->user();

        // Revoke the user's current token
        $user->tokens->each(function ($token) {
            $token->delete();
        });

        // Alternatively, if you want to just revoke the current token (if you're using personal access tokens):
        // $request->user()->currentAccessToken()->delete();

        // Clear the session user data
        session()->forget('user_id');

        return response()->json(['message' => 'Logged out successfully']);
    }
}
