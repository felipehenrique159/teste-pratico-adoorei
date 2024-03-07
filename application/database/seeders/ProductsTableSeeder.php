<?php

namespace Database\Seeders;

use App\Models\Products;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        Products::insert([
            [
                'name' => 'Iphone X',
                'price' => 1800.00,
                'description' => 'Ótimo aparelho para o dia a dia'
            ],
            [
                'name' => 'Iphone 12',
                'price' => 3200,
                'description' => 'Rápido, compacto e sistema suave'
            ],
            [
                'name' => 'Samsung S23',
                'price' => 9800.00,
                'description' => 'A melhor tecnologia'
            ]
        ]);
    }
}
