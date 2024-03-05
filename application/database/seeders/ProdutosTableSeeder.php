<?php

namespace Database\Seeders;

use App\Models\Produtos;
use Illuminate\Database\Seeder;

class ProdutosTableSeeder extends Seeder
{
    public function run(): void
    {
        Produtos::create([
            'name' => 'Iphone X',
            'price' => 1800.00,
            'description' => 'Ótimo aparelho para o dia a dia'
        ]);

        Produtos::create([
            'name' => 'Iphone 12',
            'price' => 3200,
            'description' => 'Rápido, compacto e sistema suave'
        ]);

        Produtos::create([
            'name' => 'Samsung S23',
            'price' => 9800.00,
            'description' => 'A melhor tecnologia'
        ]);
    }
}
