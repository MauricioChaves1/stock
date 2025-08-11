<?php

namespace App\Exceptions\Contracts\Production;

use Exception;
use Illuminate\Http\JsonResponse;

class ProductionNotFoundException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => 'Production not Found'
        ], 404);
    }
}
