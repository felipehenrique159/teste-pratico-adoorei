<?php

namespace App\Http\Services;

use App\Http\Repositories\ProdutosRepository;

class ProdutosService
{
    /**
     * @var ProdutosRepository
     */
    private $produtosRepository;

    public function __construct()
    {
        $this->produtosRepository = (new ProdutosRepository);
    }

    public function listarTodos() : array
    {
        return $this->produtosRepository->listarTodos();
    }
}
