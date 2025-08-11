<?php

namespace App\Http\Controllers\Service\Production;

use App\Contracts\Production\ProductionServiceInterface;
use App\Exceptions\Contracts\Production\ProductionNotFoundException;
use App\Exceptions\Contracts\Production\ProductionQuantityException;
use App\Http\Controllers\Service\Log\LogService;
use App\Models\Production;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class ProductionService implements ProductionServiceInterface
{

    public function getAllProduction(): Collection
    {
        return Production::all();
    }

    public function getProductionId(int $id): Production
    {
        $production = Production::find($id);

        if (!$production) {
            throw new ProductionNotFoundException();
        }

        return $production;
    }

    public function updateProduction(Production $production, array $data): Production
    {
        return DB::transaction(function () use ($production, $data) {
            $locked = Production::whereKey($production->getKey())->lockForUpdate()->firstOrFail();

            $delta = $this->calculateQuantityDelta($data, $locked);

            $locked->increment('quantity', $delta);

            new LogService($data, $locked);

            return $locked->refresh();
        });
    }

    private function calculateQuantityDelta(array $data, Production $production): int
    {
        $quantity = abs((int) ($data['quantity'] ?? 0));

        if ($quantity <= 0) {
            throw new ProductionQuantityException('Quantidade inválida.');
        }

        if ($data['option'] == 'out') {
            if ($production->quantity < $quantity) {
                throw new ProductionQuantityException('Quantidade solicitada excede o estoque disponível.');
            }
            $quantity = -$quantity;
        }

        return $quantity;
    }

    public function saveProduction(array $data): Production
    {
        return DB::transaction(function () use ($data) {
            $production = Production::create([
                'name'     => $data['name'],
                'quantity' => $data['quantity'],
            ]);

            new LogService($data, $production);

            return $production;
        });
    }

    public function destroyProduction(Production $production): void
    {
        $production->delete();
    }
}
