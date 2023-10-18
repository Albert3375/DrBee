<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderGuest extends Model
{
    use HasFactory;
    
    protected $table = "order_guest";

    protected $fillable = [
        'fname',
        'lname',
        'billing_address',
        'city',
        'zipcode',
        'phone',
        'email',
        'payment_method',
        'products',
        'total',
        'total_discount',
        'status_pay',
    ];

    public static $Status = [
        '1' => 'Pendiente',
        '2' => 'Pagado',
        '3' => 'Enviado',
        '4' => 'Rechazado',
        '5' => 'Devolución'
    ];
}
