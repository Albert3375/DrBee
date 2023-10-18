<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Relations\HasOne;
class BankReference extends Model
{
    use HasFactory;
    use SoftDeletes;

    /**
     * Get the user associated with the BankReference
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function bankAccount(): HasOne
    {
        return $this->hasOne(BankAccount::class, 'id', 'bank_id');
    }
}
