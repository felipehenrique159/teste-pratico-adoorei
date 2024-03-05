<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_products', function (Blueprint $table) {
            $table->id();
            $table->integer('sales_id');
            $table->integer('produto_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_products');
    }
};
