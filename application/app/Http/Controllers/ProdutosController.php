<?php

namespace App\Http\Controllers;

use App\Http\Services\ProdutosService;
use Illuminate\Http\JsonResponse;

class ProdutosController extends Controller
{
    /**
     * @var ProdutosService
     */
    private $produtosService;

    public function __construct()
    {
        $this->produtosService = (new ProdutosService);
    }

    public function listarTodos(): JsonResponse
    {
        try {
            $produtos = $this->produtosService->listarTodos();
            return response()->json($produtos);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
