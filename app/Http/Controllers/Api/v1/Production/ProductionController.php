<?php

namespace App\Http\Controllers\Api\v1\Production;

use App\Contracts\Production\ProductionServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Production\StoreProductionRequest;
use App\Http\Requests\Production\UpdateProductionRequest;
use App\Http\Resources\Production\ProductionResource;

class ProductionController extends Controller
{

    protected ProductionServiceInterface $service;

    public function __construct(ProductionServiceInterface $service)
    {
        $this->service = $service;
    }

    public function index()
    {

        $production = $this->service->getAllProduction();

        return (ProductionResource::collection($production))->response()->setStatusCode(200);
    }

    public function show(int $id)
    {

        $production = $this->service->getProductionId($id);

        return (new ProductionResource($production))->response()->setStatusCode(200);
    }

    public function store(StoreProductionRequest $request)
    {

        $data = $request->validated();

        $production = $this->service->saveProduction($data);

        return (new ProductionResource($production))->response()->setStatusCode(201);
    }

    public function update(int $id, UpdateProductionRequest $request)
    {
        $data = $request->validated();

        $production = $this->service->getProductionId($id);

        $productionUpdated = $this->service->updateProduction($production, $data);

        return (new ProductionResource($productionUpdated))->response()->setStatusCode(200);
    }

    public function destroy(int $id)
    {

        $production = $this->service->getProductionId($id);

        $this->service->destroyProduction($production);

        return response()->noContent();
    }
}
