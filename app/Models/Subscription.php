<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan_name',
        'actual_price',
        'price',
        'validity_days',
        'reward_limit',
        'description',
    ];
}
