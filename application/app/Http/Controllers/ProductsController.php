<?php

namespace App\Http\Controllers;

use App\Services\ProductsService;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    public function __construct(
        protected readonly ProductsService $productsService
    ) {}

    public function listAll(): JsonResponse
    {
        try {
            $products = $this->productsService->listAll();
            return response()->json($products, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
