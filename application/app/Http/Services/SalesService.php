<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductsRepository;
use App\Http\Repositories\SalesRepository;

class SalesService
{
    /**
     * @var SalesRepository
     */
    private $salesRepository;

    public function __construct()
    {
        $this->salesRepository = (new SalesRepository);
    }

    public function processSale($request)
    {
        $totalSumProducts = (new ProductsRepository)->sumPriceProducts($request->idsProducts);

        $sale = $this->salesRepository->save([
            'amount' => $totalSumProducts
        ]);

        $this->salesRepository->syncProducts($sale, $request->idsProducts);

        return $this->salesRepository->saleWithProducts($sale->sales_id);
    }
}
