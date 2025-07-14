<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillReward extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_no', 'user_id', 'amount', 'reward', 'status', 'bill_pdf'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
