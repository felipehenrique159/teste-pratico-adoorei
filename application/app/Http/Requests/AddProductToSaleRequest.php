<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class AddProductToSaleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'saleId' => 'required|integer',
            'idsProducts' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'saleId.required' => 'saleId is required.',
            'saleId.integer' => 'saleId must be integer.',
            'idsProducts.required' => 'idsProducts is required.',
            'idsProducts.array' => 'idsProducts must be array.'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse([
            'result' => 'Error',
            'message' => 'invalid data',
            'errors' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
