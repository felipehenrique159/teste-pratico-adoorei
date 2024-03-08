<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddProductToSaleRequest;
use App\Http\Requests\ProcessSaleRequest;
use App\Services\SalesService;
use Illuminate\Http\JsonResponse;

class SalesController extends Controller
{
    public function __construct(
        protected readonly SalesService $salesService
    ) {}

    public function processSale(ProcessSaleRequest $request): JsonResponse
    {
        $processSale = $this->salesService->processSale($request);

        return response()->json($processSale);
    }

    public function canceledSale(int $idSale): JsonResponse
    {
        $this->salesService->canceledSale($idSale);

        return response()->json([
            'success' => true,
            'message' => 'Sale canceled successfully'
        ]);
    }

    public function showSale(int $idSale): JsonResponse
    {
        $sale = $this->salesService->showSale($idSale);

        return response()->json($sale);
    }

    public function listAll(): JsonResponse
    {
        $allSales = $this->salesService->listAll();

        return response()->json($allSales);
    }

    public function addProductToSale(AddProductToSaleRequest $request): JsonResponse
    {
        $this->salesService->addProductToSale($request);

        return response()->json([
            'success' => true,
            'message' => 'Products added to sale'
        ]);
    }
}
