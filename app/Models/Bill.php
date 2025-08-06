<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Bill extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'bill_number',
        'file',
        'cashback',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
