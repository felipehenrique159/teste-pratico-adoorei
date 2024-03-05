<?php

namespace App\Http\Repositories;

use App\Models\Produtos;

class ProdutosRepository
{
    public function listarTodos(): array
    {
        return Produtos::all()->toArray();
    }
}
