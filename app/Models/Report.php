<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'report_type',
        'report_name',
        'report_date',
        'total_entries',
        'status',
    ];
}
