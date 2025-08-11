<?php

namespace App\Exceptions\Contracts\Production;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductionSaveException extends Exception
{
    public function render(): JsonResponse
    {
        return response()->json([
            'error' => 'Erro ao realizar cadastro do produto'
        ], 400);
    }
}
