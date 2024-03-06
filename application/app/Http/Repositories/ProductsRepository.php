<?php

namespace App\Http\Repositories;

use App\Models\Products;

class ProductsRepository
{
    public function listAll(): array
    {
        return Products::select('name', 'price', 'description')->get()->toArray();
    }

    public function sumPriceProducts($idsProducts)
    {
        return Products::whereIn('product_id', $idsProducts)->sum('price');
    }
}
