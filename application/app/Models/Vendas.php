<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    use HasFactory;

    protected $primaryKey = 'sales_id';

    public $table = 'vendas';

    protected $fillable = [
        'amount',
        'canceled',
        'canceled_date'
    ];
}
