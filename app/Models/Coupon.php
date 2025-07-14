<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'code',
        'discount',
        'usage_limit',
        'used',
        'limit_days',
        'expiry_date',
        'status',
    ];
}
