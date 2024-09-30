<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) : JsonResponse
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) 
        {
            $user = Auth::user();
            $token = $request->user()->createToken('api-token')->plainTextToken;

            return response()->json([
                'status' => true,
                'token' => $token,
                'user' => $user
            ], 200);
        }
        else 
        {
            return response()->json([
                'status' => false,
                'message' => "The email or password are be incorrects"
            ], 401);
        }
    }

    public function logout(User $user) : JsonResponse
    {
        try
        {
            $user->tokens()->delete();
            return response()->json([
                'status' => true,
                'user' => "User logged out with success"
            ], 200);
        }
        catch(Exception $ex)
        {
            return response()->json([
                'status' => false,
                'message' => "User was not logged out"
            ], 400);
        }
    }
}
