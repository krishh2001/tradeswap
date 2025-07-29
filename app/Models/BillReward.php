<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillReward extends Model
{
    use HasFactory;

    protected $fillable = [
        'plan',
        'bill_no',
        'user_id',
        'amount',
        'reward',
        'bill_pdf',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
