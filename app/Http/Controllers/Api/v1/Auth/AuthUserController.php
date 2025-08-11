<?php

namespace App\Http\Controllers\Api\v1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Service\Auth\AuthService;
use App\Http\Resources\User\AuthResource;
use App\Http\Resources\User\ErrorAuthResource;
use Illuminate\Http\Request;

class AuthUserController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        $result = $this->authService->login($credentials);

        $resourceClass = $result['success'] ? AuthResource::class : ErrorAuthResource::class;
        return $resourceClass::make($result['data'])->response()->setStatusCode($result['status']);
    }
}
