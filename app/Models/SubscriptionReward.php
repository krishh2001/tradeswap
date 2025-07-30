<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubscriptionReward extends Model
{
    protected $fillable = [
        'user_id',
        'subscription_id',
        'reward',
        'starts_at',
        'ends_at',
    ];

    protected $dates = ['starts_at', 'ends_at'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function plan(): BelongsTo
    {
        return $this->belongsTo(Subscription::class, 'subscription_id');
    }
}
