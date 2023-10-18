<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use \Illuminate\Database\Eloquent\Relations\HasOne;
class OrderUser extends Model
{
    use HasFactory;
    
    protected $table = 'order_user';

    protected $fillable = [
        'user_id',
        'address_id',
        'payment_method',
        'products',
        'total',
        'status_pay',
    ];

    /**
     * Get the user associated with the OrderUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class,'id','user_id');
    }
    /**
     * Get the address associated with the OrderUser
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function address(): HasOne
    {
        return $this->hasOne(Adress::class, 'id', 'address_id');
    }

    public static $Status = [
        '1' => 'Pendiente',
        '2' => 'Pagado',
        '3' => 'Enviado',
        '4' => 'Rechazado',
        '5' => 'Devolución'
    ];
}
