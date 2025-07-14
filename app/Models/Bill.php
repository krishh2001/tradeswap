<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

// app/Models/Bill.php
class Bill extends Model
{
    protected $fillable = ['bill_no', 'user_id', 'amount', 'cashback', 'status'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
