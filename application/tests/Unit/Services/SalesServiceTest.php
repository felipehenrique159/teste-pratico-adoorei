<?php

namespace Tests\Unit\Services;

use App\Exceptions\SalesServiceException;
use App\Models\Sales;
use App\Repositories\ProductsRepository;
use App\Repositories\SalesRepository;
use App\Services\SalesService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use PHPUnit\Framework\TestCase;

class SalesServiceTest extends TestCase
{
    protected $salesRepositoryMock;
    protected $productsRepositoryMock;
    protected $salesService;
    protected $sales;

    protected function setUp(): void
    {
        parent::setUp();

        $this->salesRepositoryMock = $this->createMock(SalesRepository::class);
        $this->productsRepositoryMock = $this->createMock(ProductsRepository::class);
        $this->salesService = new SalesService($this->salesRepositoryMock, $this->productsRepositoryMock);
        $this->sales = new Sales;
    }

    protected function tearDown(): void
    {
        $this->salesRepositoryMock = null;
        $this->productsRepositoryMock = null;
        $this->salesService = null;

        parent::tearDown();
    }

    public function testProcessSale()
    {
        $requestMock = $this->createMock(Request::class);
        $requestMock->idsProducts = [1, 2, 3];

        $this->productsRepositoryMock->expects($this->once())
            ->method('sumPriceProducts')
            ->with($requestMock->idsProducts)
            ->willReturn(1000.00);

        $sale = $this->sales;
        $sale->sales_id = 1;

        $this->salesRepositoryMock->expects($this->once())
            ->method('save')
            ->willReturn($sale);

        $this->salesRepositoryMock->expects($this->once())
            ->method('addProductsToSale');

        $this->salesRepositoryMock->expects($this->once())
            ->method('saleWithProducts')
            ->willReturn(['sales_id' => 1]);

        $result = $this->salesService->processSale($requestMock);

        $this->assertEquals(['sales_id' => 1], $result);
    }

    public function testCanceledSale()
    {
        $this->salesRepositoryMock->expects($this->once())
            ->method('verifyIfExists')
            ->with(1)
            ->willReturn(true);

        $this->salesRepositoryMock->expects($this->once())
            ->method('updateSaleForCanceled')
            ->with(1);

        $result = $this->salesService->canceledSale(1);

        $this->assertTrue($result);
    }

    public function testCanceledSaleThrowsExceptionIfSaleNotExists()
    {
        $this->salesRepositoryMock->expects($this->once())
            ->method('verifyIfExists')
            ->with(1)
            ->willReturn(false);

        $this->expectException(SalesServiceException::class);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);

        $this->salesService->canceledSale(1);
    }

    public function testShowSale()
    {
        $this->salesRepositoryMock->expects($this->once())
            ->method('verifyIfExists')
            ->willReturn(true);

        $this->salesRepositoryMock->expects($this->once())
            ->method('saleWithProducts')
            ->willReturn(['sales_id' => 1]);

        $result = $this->salesService->showSale(1);

        $this->assertEquals(['sales_id' => 1], $result);
    }

    public function testListAll()
    {
        $this->salesRepositoryMock->expects($this->once())
            ->method('listAllSalesWithProducts')
            ->willReturn([]);

        $result = $this->salesService->listAll();

        $this->assertEquals([], $result);
    }

    public function testAddProductToSale()
    {
        $requestMock = $this->createMock(Request::class);
        $requestMock->saleId = 1;
        $requestMock->idsProducts = [1, 2, 3];

        $sale = $this->sales;
        $sale->amount = 1500.00;

        $this->salesRepositoryMock->expects($this->once())
            ->method('verifyIfExists')
            ->willReturn(true);

        $this->productsRepositoryMock->expects($this->once())
            ->method('sumPriceProducts')
            ->with($requestMock->idsProducts)
            ->willReturn(3200.00);

        $this->salesRepositoryMock->expects($this->once())
            ->method('find')
            ->with($requestMock->saleId)
            ->willReturn($sale);

        $this->salesRepositoryMock->expects($this->once())
            ->method('addProductsToSale')
            ->with($sale, $requestMock->idsProducts);

        $this->salesRepositoryMock->expects($this->once())
            ->method('updateAmount')
            ->with($sale, 4700.00)
            ->willReturn(true);

        $result = $this->salesService->addProductToSale($requestMock);

        $this->assertTrue($result);
    }

    public function testAddProductToSaleThrowsExceptionIfSaleNotExists()
    {
        $requestMock = $this->createMock(Request::class);
        $requestMock->saleId = 1;
        $requestMock->idsProducts = [1, 2, 3];

        $sale = $this->sales;
        $sale->amount = 1500.00;

        $this->salesRepositoryMock->expects($this->once())
            ->method('verifyIfExists')
            ->willReturn(false);

        $this->expectException(SalesServiceException::class);
        $this->expectExceptionCode(Response::HTTP_NOT_FOUND);

        $this->salesService->addProductToSale($requestMock);
    }
}
