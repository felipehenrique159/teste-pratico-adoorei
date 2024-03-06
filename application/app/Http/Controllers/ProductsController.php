<?php

namespace App\Http\Controllers;

use App\Http\Services\ProductsService;
use Illuminate\Http\JsonResponse;

class ProductsController extends Controller
{
    /**
     * @var ProductsService
     */
    private $productsService;

    public function __construct()
    {
        $this->productsService = (new ProductsService);
    }

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
