<?php

namespace App\Exceptions\Contracts\Production;

use Exception;
use Illuminate\Http\JsonResponse;

class ProductionQuantityException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => 'Quantidade solicitada para retirada excede o estoque disponível'
        ], 400);
    }
}
