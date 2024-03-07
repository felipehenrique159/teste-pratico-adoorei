<?php

namespace Tests\Unit\Services;

use App\Repositories\ProductsRepository;
use App\Services\ProductsService;
use PHPUnit\Framework\TestCase;

class ProductsServiceTest extends TestCase
{
    protected $productsRepositoryMock;
    protected $productsService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->productsRepositoryMock = $this->createMock(ProductsRepository::class);
        $this->productsService = new ProductsService($this->productsRepositoryMock);
    }

    protected function tearDown(): void
    {
        $this->productsRepositoryMock = null;
        $this->productsService = null;

        parent::tearDown();
    }

    public function testListAll()
    {
        $this->productsRepositoryMock->expects($this->once())
            ->method('listAll')
            ->willReturn([]);

        $result = $this->productsService->listAll();

        $this->assertEquals([], $result);
    }

    public function testSumPriceProducts()
    {
        $idsProducts = [1, 2, 3];

        $productPrices = [
            1 => 1000.00,
            2 => 2000.00,
            3 => 3000.00
        ];

        $this->productsRepositoryMock->expects($this->once())
            ->method('sumPriceProducts')
            ->with($idsProducts)
            ->willReturn(array_sum($productPrices));

        $result = $this->productsRepositoryMock->sumPriceProducts($idsProducts);

        $this->assertEquals(6000.00, $result);
    }
}
