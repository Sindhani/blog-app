<?php

namespace App\Http\Controllers;

use App\Dto\LoginDto;
use App\Exceptions\BaseException;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private readonly AuthService $authService
    )
    {
    }

    /**
     * @throws BaseException
     */
    public function login(Request $request): JsonResponse
    {
        $request->validate(['email' => 'required', 'otp' => 'required']);
        $credentials = LoginDto::fromRequest($request);
        return $this->respondWithToken($this->authService->login($credentials));
    }

    protected function respondWithToken($token): JsonResponse
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }

    public function me(): JsonResponse
    {
        return response()->json(auth()->user());
    }

    public function logout(): JsonResponse
    {
        auth()->logout();
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function register(Request $request): JsonResponse
    {
        $request->validate(['name' => 'required', 'email' => 'required|email|unique:users']);
        $credentials = $request->only('name', 'email');
        $model = $this->authService->register($credentials);
        return response()->json(['message' => 'User successfully registered, Sign in to continue.']);
    }
}
