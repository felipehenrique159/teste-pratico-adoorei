<?php

namespace App\Repositories;

use App\Models\Sales;
use Carbon\Carbon;

class SalesRepository
{
    public function find(int $idSale): Sales|null
    {
        return Sales::find($idSale);
    }

    public function verifyIfExists(int $idSale): bool
    {
        return Sales::where('sales_id', $idSale)->exists();
    }

    public function save($data): Sales
    {
        return Sales::create($data);
    }

    public function addProductsToSale(Sales $sale, array $idsProducts): void
    {
        $sale->products()->attach($idsProducts);
    }

    public function saleWithProducts(int $saleId): array|null
    {
        return Sales::with('products')
            ->select('sales_id', 'amount', 'canceled', 'canceled_date')
            ->find($saleId)
            ->toArray();
    }

    public function listAllSalesWithProducts(): array
    {
        return Sales::with('products')
            ->select('sales_id', 'amount', 'canceled', 'canceled_date')
            ->get()
            ->toArray();
    }

    public function updateSaleForCanceled(int $idSale): bool
    {
        return Sales::where('sales_id', $idSale)
            ->update([
                'canceled' => 1,
                'canceled_date' => Carbon::now()
            ]);
    }

    public function updateAmount(Sales $sale, float $amount): bool
    {
        return $sale->update(['amount' => $amount]);
    }
}
