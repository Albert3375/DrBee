<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'image',
        'category_id', // Agregar category_id como fillable
        'stock',
        'is_active',
        'product_type', // Agregar product_type como fillable
    ];

    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'price' => 'decimal:2',
        'is_active' => 'boolean',
    ];

    /**
     * Relación con el modelo Category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
