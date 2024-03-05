<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductsRepository;

class ProductsService
{
    /**
     * @var ProductsRepository
     */
    private $productsRepository;

    public function __construct()
    {
        $this->productsRepository = (new ProductsRepository);
    }

    public function listAll(): array
    {
        return $this->productsRepository->listAll();
    }
}
