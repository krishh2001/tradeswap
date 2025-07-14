<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportTicket extends Model
{
    protected $fillable = [
        'user_name',
        'user_email',
        'subject',
        'message',
        'reply',
        'status',
    ];
}
