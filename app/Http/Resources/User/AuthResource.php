<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'access_token' => $this['access_token'] ?? null,
            'token_type'   => $this['token_type']   ?? 'bearer',
            'expires_in'   => $this['expires_in']   ?? null,
        ];
    }
}
