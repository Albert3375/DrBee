<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{

    
    use HasFactory;

    protected $table = 'sessions';

    protected $fillable = [
        'product_id',
        'name',
        'quantity',
        'discount',
        'price',
        'priceDiscount',
        'totalDiscount',
        'img',
        'category_id',
        'session_estatus',
    ];
}
