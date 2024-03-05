<?php

namespace App\Http\Controllers;

use App\Http\Services\ProdutosService;
use Illuminate\Http\Request;

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

    public function listarTodos() : array{
        try {
            return $this->produtosService->listarTodos();
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
