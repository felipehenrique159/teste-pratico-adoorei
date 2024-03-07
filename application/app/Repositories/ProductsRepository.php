<?php

namespace App\Repositories;

use App\Models\Products;

class ProductsRepository
{
    public function listAll(): array
    {
        return Products::select('name', 'price', 'description')->get()->toArray();
    }

    public function sumPriceProducts(array $idsProducts): float
    {
        return Products::whereIn('product_id', $idsProducts)->sum('price');
    }
}
