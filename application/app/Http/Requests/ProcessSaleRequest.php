<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

class ProcessSaleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'idsProducts' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'idsProducts.required' => 'idsProducts is required.',
            'idsProducts.array' => 'idsProducts must be array.'
        ];
    }

    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = new JsonResponse([
            'result' => 'Error',
            'message' => 'Dados Inválidos',
            'errors' => $validator->errors()
        ], 422);

        throw new \Illuminate\Validation\ValidationException($validator, $response);
    }
}
