<?php

namespace App\Services;

use App\Exceptions\SalesServiceException;
use App\Repositories\ProductsRepository;
use App\Repositories\SalesRepository;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;

class SalesService
{
    public function __construct(
        private readonly SalesRepository $salesRepository,
        private readonly ProductsRepository $productsRepository
    ) {}

    public function processSale(Request $request): array
    {
        $newProductsTotalPrice = $this->productsRepository->sumPriceProducts($request->idsProducts);

        $sale = $this->salesRepository->save([
            'amount' => $newProductsTotalPrice
        ]);

        $this->salesRepository->addProductsToSale($sale, $request->idsProducts);

        return $this->salesRepository->saleWithProducts($sale->sales_id);
    }

    public function canceledSale(int $idSale): bool
    {
        if (!$this->salesRepository->verifyIfExists($idSale)) {
            throw new SalesServiceException('Sale does not exist', Response::HTTP_NOT_FOUND);
        }

        $this->salesRepository->updateSaleForCanceled($idSale);

        return true;
    }

    public function showSale(int $idSale): array
    {
        if (!$this->salesRepository->verifyIfExists($idSale)) {
            throw new SalesServiceException('Sale does not exist', Response::HTTP_NOT_FOUND);
        }

        return $this->salesRepository->saleWithProducts($idSale);
    }

    public function listAll(): array
    {
        return $this->salesRepository->listAllSalesWithProducts();
    }

    public function addProductToSale(Request $request): bool
    {
        if (!$this->salesRepository->verifyIfExists($request->saleId)) {
            throw new SalesServiceException('Sale does not exist', Response::HTTP_NOT_FOUND);
        }

        $newProductsTotalPrice = $this->productsRepository->sumPriceProducts($request->idsProducts);

        $sale = $this->salesRepository->find($request->saleId);

        $this->salesRepository->addProductsToSale($sale, $request->idsProducts);

        $newAmount = $sale->amount + $newProductsTotalPrice;

        $this->salesRepository->updateAmount($sale, $newAmount);

        return true;
    }
}
