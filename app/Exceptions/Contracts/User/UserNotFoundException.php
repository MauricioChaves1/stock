<?php

namespace App\Exceptions\Contracts\User;


use Exception;
use Illuminate\Http\Client\Request;
use Illuminate\Http\JsonResponse;

class UserNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => 'User Not Found'
        ], 404);
    }
}
