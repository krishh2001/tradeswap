<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Hash;
use App\Models\BillReward;



class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'profile_photo',
        'name',
        'email',
        'mobile_number',
        'password',
        'referral_code',
        'referred_by',
        'email_otp',
        'is_email_verified',
        'wallet_reward', 
        'wallet_cashback',
        'status',
        'date_of_joining',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'wallet_balance' => 'decimal:2',
        'email_verified_at' => 'datetime',
        'date_of_joining' => 'date',
    ];

    public function setPasswordAttribute($value)
    {
        if (!empty($value)) {
            $this->attributes['password'] = Hash::make($value);
        }
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by');
    }

    public function billRewards()
    {
        return $this->hasMany(BillReward::class, 'user_id');
    }
}
