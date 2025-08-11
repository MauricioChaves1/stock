<?php

namespace App\Contracts\Production;

use App\Models\Production;
use Illuminate\Database\Eloquent\Collection;

interface ProductionServiceInterface
{
    public function getAllProduction(): Collection;
    public function getProductionId(int $id): Production;
    public function saveProduction(array $data): Production;
    public function updateProduction(Production $production,array $data): Production;
    public function destroyProduction(Production $production): void;
}
