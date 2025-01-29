<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Authenticate user and return API token.
     *
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        if (!Auth::attempt($request->validated())) {
            return response()->json(['error' => 'Wrong email or password.']);
        }
        $user = User::query()->where('email', $request->email)->first();

        return response()->json([
            'message' => 'Logged in successfully.',
            'token' => $user->createToken('api')->plainTextToken,
        ]);
    }

    /**
     * Register a new user and return user data.
     *
     * @bodyParam password_confirmation string required Your confirmed password No-example
     * @param  RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        return response()->json([
            'message' => 'Registered successfully.',
            'user' => User::query()->create($request->validated()),
        ]);
    }
}
