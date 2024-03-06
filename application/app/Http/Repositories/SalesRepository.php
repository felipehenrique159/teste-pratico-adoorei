<?php

namespace App\Http\Repositories;

use App\Models\Sales;
use Carbon\Carbon;

class SalesRepository
{

    public function verifyIfExists($idSale)
    {
        return Sales::where('sales_id', $idSale)->exists();
    }

    public function save($data)
    {
        return Sales::create($data);
    }

    public function saleWithProducts($saleId)
    {
        return Sales::with('products')->find($saleId);
    }

    public function listAllsalesWithProducts()
    {
        return Sales::with('products')->get();
    }

    public function syncProducts($sale, $idsProducts)
    {
        $sale->products()->sync($idsProducts);
    }

    public function updateSaleForCanceled($idSale)
    {
        return Sales::where('sales_id', $idSale)
            ->update([
                'canceled' => 1,
                'canceled_date' => Carbon::now()
            ]);
    }
}
