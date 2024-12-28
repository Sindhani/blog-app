<?php

namespace App\Services;

use App\Dto\LoginDto;
use App\Exceptions\BaseException;
use App\Models\User;
use App\Notifications\OtpNotification;
use App\Utils\ApiResponse;

class AuthService
{
    /**
     * @throws BaseException
     */
    public function login(LoginDto $loginDto): string
    {
        $user = User::query()->where('email', $loginDto->email)->first();

        if (!$user || $user->otp !== $loginDto->otp || now()->greaterThan($user->otp_expires_at)) {
            throw new BaseException('Invalid or expired OTP', ApiResponse::HTTP_UNAUTHORIZED);
        }

        $user->update(['otp' => null, 'otp_expires_at' => null]);

        return auth()->login($user);


    }

    public function sendOtp(string $email): bool
    {
        $user = User::query()->where('email', $email)->first();
        $otp = $this->generateOtp($user);
        $user->notify(new OtpNotification($otp));
        return true;
    }

    function generateOtp($user): string
    {
        $otp = rand(100000, 999999);
        $user->update([
            'otp' => $otp,
            'otp_expires_at' => now()->addMinutes(5),
        ]);
        return $otp;
    }

    public function register(array $credentials): User
    {
        $credentials['password'] = bcrypt('password');
        return User::query()->create($credentials);
    }


}
