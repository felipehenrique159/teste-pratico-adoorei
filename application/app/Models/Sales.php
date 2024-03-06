<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    use HasFactory;

    protected $primaryKey = 'sales_id';

    public $table = 'sales';

    protected $fillable = [
        'amount',
        'canceled',
        'canceled_date'
    ];

    public function products()
    {
        return $this->belongsToMany(Products::class, 'sales_products', 'sales_id', 'product_id');
    }
}
