<?php

namespace App\Http\Repositories;

use App\Models\Sales;

class SalesRepository
{
    public function save($data)
    {
        return Sales::create($data);
    }

    public function saleWithProducts($saleId)
    {
        return Sales::with('products')->find($saleId);
    }

    public function syncProducts($sale, $idsProducts)
    {
        $sale->products()->sync($idsProducts);
    }
}
