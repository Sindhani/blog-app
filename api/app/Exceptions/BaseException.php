<?php

namespace App\Exceptions;

use App\Utils\ApiResponse;
use Exception;
use Illuminate\Http\JsonResponse;

class BaseException extends Exception
{
    public function __construct(string $message = "", int $code = ApiResponse::HTTP_BAD_REQUEST, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse
    {
        return response()->json([
            'code' => $this->code,
            'message' => $this->message,
        ], ApiResponse::HTTP_BAD_REQUEST);
    }
}
