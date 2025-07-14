<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Table name (optional if it follows Laravel convention)
    protected $table = 'products';

    // Mass assignable fields
    protected $fillable = [
        'name',
        'price',
        'stock',
        'status',
    ];

    // Casts (optional)
    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer',
    ];

    // Accessor example (optional)
    public function getFormattedPriceAttribute()
    {
        return '$' . number_format($this->price, 2);
    }

    // Scope example (optional)
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }
}
