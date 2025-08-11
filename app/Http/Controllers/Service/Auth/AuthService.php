<?php

namespace App\Http\Controllers\Service\Auth;

use Illuminate\Support\Facades\Auth;

class AuthService
{
    public function login(array $credentials): array
    {
        $token = Auth::attempt($credentials);

        if (!$token) {
            return [
                'success' => false,
                'data'    => ['error' => 'Email or Password incorrect'],
                'status'  => 401
            ];
        }

        return [
            'success' => true,
            'data'    => $this->respondWithToken($token),
            'status'  => 200
        ];
    }

    public function getAuthenticatedUser()
    {
        return Auth::user();
    }

    public function logout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect('/');
    }


    public function refreshToken(): array
    {
        $token = Auth::refresh();

        return $this->respondWithToken($token);
    }

    private function respondWithToken(string $token): array
    {
        return [
            'access_token' => $token,
            'token_type'   => 'bearer',
            'expires_in'   => Auth::factory()->getTTL() * 60
        ];
    }
}
