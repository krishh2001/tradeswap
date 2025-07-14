<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'user_id', 'plan', 'amount', 'payment_method', 'date', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
