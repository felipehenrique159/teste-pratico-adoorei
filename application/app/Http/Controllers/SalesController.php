<?php

namespace App\Http\Controllers;

use App\Http\Services\SalesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * @var SalesService
     */
    private $salesService;

    public function __construct()
    {
        $this->salesService = (new SalesService);
    }

    public function processSale(Request $request): JsonResponse
    {
        try {
            $response = $this->salesService->processSale($request);
            return response()->json($response, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function canceledSale($idSale): JsonResponse
    {
        try {
            $response = $this->salesService->canceledSale($idSale);
            if (isset($response['error'])) {
                return response()->json($response, 404);
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function showSale($idSale): JsonResponse
    {
        try {
            $response = $this->salesService->showSale($idSale);
            if (isset($response['error'])) {
                return response()->json($response, 404);
            }
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function listAll(): JsonResponse
    {
        try {
            $response = $this->salesService->listAll();
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function addProductToSale(Request $request): JsonResponse
    {
        try {
            $response = $this->salesService->addProductToSale($request);
            return response()->json($response, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
