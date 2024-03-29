<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $primaryKey = 'product_id';

    public $table = 'products';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'description'
    ];
}
