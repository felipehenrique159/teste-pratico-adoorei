<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class SalesServiceException extends Exception
{
    public function render()
    {
        return response()->json([
            'success' => false,
            'error' => $this->message
        ], $this->code === 0 ? Response::HTTP_INTERNAL_SERVER_ERROR : $this->code );
    }
}
