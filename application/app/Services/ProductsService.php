<?php

namespace App\Services;

use App\Repositories\ProductsRepository;

class ProductsService
{
    public function __construct(
        private readonly ProductsRepository $productsRepository
    ) {}

    public function listAll(): array
    {
        return $this->productsRepository->listAll();
    }
}
