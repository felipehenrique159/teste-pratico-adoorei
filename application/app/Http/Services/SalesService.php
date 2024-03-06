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

    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    public function __construct()
    {
        $this->salesRepository = (new SalesRepository);
        $this->productsRepository = (new ProductsRepository);
    }

    public function processSale($request)
    {
        $totalSumProducts = $this->productsRepository->sumPriceProducts($request->idsProducts);

        $sale = $this->salesRepository->save([
            'amount' => $totalSumProducts
        ]);

        $this->salesRepository->addProductsToSale($sale, $request->idsProducts);

        return $this->salesRepository->saleWithProducts($sale->sales_id);
    }

    public function canceledSale($idSale)
    {
        if (!$this->salesRepository->verifyIfExists($idSale)) {
            return ['error' => 'Sale does not exist'];
        }

        $this->salesRepository->updateSaleForCanceled($idSale);

        return ['message' => 'Sale canceled successfully'];
    }

    public function showSale($idSale)
    {
        if (!$this->salesRepository->verifyIfExists($idSale)) {
            return ['error' => 'Sale does not exist'];
        }

        return $this->salesRepository->saleWithProducts($idSale);
    }

    public function listAll()
    {
        return $this->salesRepository->listAllSalesWithProducts();
    }

    public function addProductToSale($request)
    {
        if (!$this->salesRepository->verifyIfExists($request->saleId)) {
            return ['error' => 'Sale does not exist'];
        }

        $totalSumProducts = $this->productsRepository->sumPriceProducts($request->idsProducts);
        $sale = $this->salesRepository->find($request->saleId);

        $this->salesRepository->addProductsToSale($sale, $request->idsProducts);

        $newAmount = $sale->amount + $totalSumProducts;

        $this->salesRepository->updateAmount($sale, $newAmount);

        return ['message' => 'Products added to sale'];
    }
}
