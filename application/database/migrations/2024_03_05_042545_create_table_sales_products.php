<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sales_products', function (Blueprint $table) {
            $table->integer('id')->autoIncrement();
            $table->integer('sales_id');
            $table->integer('product_id');

            $table->foreign('sales_id')
                ->references('sales_id')
                ->on('sales')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sales_products');
    }
};
