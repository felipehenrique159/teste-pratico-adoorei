<?php

namespace App\Http\Controllers;

use App\Http\Services\SalesService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    /**
     * @var SalesService
     */
    private $salesService;

    public function __construct()
    {
        $this->salesService = (new SalesService);
    }

    public function processSale(Request $request)
    {
        try {
            return $this->salesService->processSale($request);
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
