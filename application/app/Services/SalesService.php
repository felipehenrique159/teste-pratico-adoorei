<?php

namespace App\Services;

use App\Exceptions\SalesServiceException;
use App\Repositories\ProductsRepository;
use App\Repositories\SalesRepository;
use Symfony\Component\HttpFoundation\Response;

class SalesService
{
    public function __construct(
        private readonly SalesRepository $salesRepository,
        private readonly ProductsRepository $productsRepository
    ) {}

    public function processSale($request)
    {
        $totalSumProducts = $this->productsRepository->sumPriceProducts($request->idsProducts);

        $sale = $this->salesRepository->save([
            'amount' => $totalSumProducts
        ]);

        $this->salesRepository->addProductsToSale($sale, $request->idsProducts);

        return $this->salesRepository->saleWithProducts($sale->sales_id);
    }

    public function canceledSale($idSale): bool
    {
        if (!$this->salesRepository->verifyIfExists($idSale)) {
            throw new SalesServiceException('Sale does not exist', Response::HTTP_NOT_FOUND);
        }

        $this->salesRepository->updateSaleForCanceled($idSale);

        return true;
    }

    public function showSale($idSale)
    {
        if (!$this->salesRepository->verifyIfExists($idSale)) {
            throw new SalesServiceException('Sale does not exist', Response::HTTP_NOT_FOUND);
        }

        return $this->salesRepository->saleWithProducts($idSale);
    }

    public function listAll()
    {
        return $this->salesRepository->listAllSalesWithProducts();
    }

    public function addProductToSale($request): bool
    {
        if (!$this->salesRepository->verifyIfExists($request->saleId)) {
            throw new SalesServiceException('Sale does not exist', Response::HTTP_NOT_FOUND);
        }

        $totalSumProducts = $this->productsRepository->sumPriceProducts($request->idsProducts);
        $sale = $this->salesRepository->find($request->saleId);

        $this->salesRepository->addProductsToSale($sale, $request->idsProducts);

        $newAmount = $sale->amount + $totalSumProducts;

        $this->salesRepository->updateAmount($sale, $newAmount);

        return true;
    }
}
