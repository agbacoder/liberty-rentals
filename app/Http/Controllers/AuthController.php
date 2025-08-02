<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    //Register new user
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        try {
            $user = User::create([
                'name'     => $validated['name'],
                'email'    => $validated['email'],
                'password' => Hash::make($validated['password']),
            ]);

            return response()->json([
                'message' => 'User registered successfully',
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Unable to register user',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }

    // login user
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($validated)) {
            return response()->json([
                'message' => 'Invalid credentials',
            ], 401);
        }

        try {
            $user  = Auth::user();

            $user->tokens()->delete();

            $token = $user->createToken('access_token')->accessToken;

            return response()->json([
                'status'  => 'success',
                'data'    => [
                'token' => $token,
                'user'  => $user,
                
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Login failed.',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
