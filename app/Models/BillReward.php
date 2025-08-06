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
        'cashback',
        'bill_pdf',
        'remaining_days', 
        'status',
        'starts_at',
        'ends_at',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'amount' => 'decimal:2',
        'reward' => 'decimal:2',
        'cashback' => 'decimal:2', 
    ];

  public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}


}
