<?php

namespace App\Http\Controllers;

use App\Services\AuthService;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function __construct(private readonly AuthService $authService)
    {
    }

    public function __invoke(Request $request)
    {
        $request->validate(['email' => 'required|email|exists:users,email']);
        $this->authService->sendOtp($request->get('email'));
        return response()->json(['message' => 'OTP sent']);
    }
}
