<?php

namespace App\Http\Repositories;

use App\Models\Products;

class ProductsRepository
{
    public function listAll(): array
    {
        return Products::all()->toArray();
    }
}
