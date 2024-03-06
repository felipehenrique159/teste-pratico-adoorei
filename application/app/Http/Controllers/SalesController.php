<?php

namespace App\Http\Controllers;

use App\Services\SalesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function __construct(
        protected readonly SalesService $salesService
    ) {}

    public function processSale(Request $request): JsonResponse
    {
        $processSale = $this->salesService->processSale($request);
        return response()->json($processSale);
    }

    public function canceledSale($idSale): JsonResponse
    {
        $this->salesService->canceledSale($idSale);

        return response()->json([
            'success' => true,
            'message' => 'Sale canceled successfully'
        ]);
    }

    public function showSale($idSale): JsonResponse
    {
        $sale = $this->salesService->showSale($idSale);

        return response()->json($sale);
    }

    public function listAll(): JsonResponse
    {
        $allSales = $this->salesService->listAll();

        return response()->json($allSales);
    }

    public function addProductToSale(Request $request): JsonResponse
    {
        $this->salesService->addProductToSale($request);

        return response()->json([
            'success' => true,
            'message' => 'Products added to sale'
        ]);
    }
}
