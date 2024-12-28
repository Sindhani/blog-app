<?php

namespace App\Dto;


use Illuminate\Http\Request;

class LoginDto
{
    /**
     * Create a new class instance.
     */
    public function __construct(
        public string $email,
        public string $otp,
    )
    {
        //
    }

    public static function fromRequest(Request $request): static
    {
        $otp = implode('', $request->get('otp'));
        return new self(
            email: $request->get('email'),
            otp: $otp,
        );
    }


    public function toArray(): array
    {
        $otp = implode('', $this->otp);
        return [
            'email' => $this->email,
            'top' => $otp
        ];
    }
}
