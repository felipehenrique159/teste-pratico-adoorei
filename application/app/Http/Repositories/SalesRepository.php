<?php

namespace App\Http\Repositories;

use App\Models\Sales;
use Carbon\Carbon;

class SalesRepository
{
    public function find($idSale)
    {
        return Sales::find($idSale);
    }

    public function verifyIfExists($idSale)
    {
        return Sales::where('sales_id', $idSale)->exists();
    }

    public function save($data)
    {
        return Sales::create($data);
    }

    public function addProductsToSale($sale, $idsProducts)
    {
        $sale->products()->attach($idsProducts);
    }

    public function saleWithProducts($saleId)
    {
        return Sales::with('products')->find($saleId);
    }

    public function listAllSalesWithProducts()
    {
        return Sales::with('products')->get();
    }

    public function updateSaleForCanceled($idSale)
    {
        return Sales::where('sales_id', $idSale)
            ->update([
                'canceled' => 1,
                'canceled_date' => Carbon::now()
            ]);
    }

    public function updateAmount($sale, $amount)
    {
        return $sale->update([
                'amount' => $amount
            ]);
    }
}
