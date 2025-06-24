<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeeklyMailing extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_division_unit',
        'date_records_received',
        'consignee',
        'content',
        'courier',
        'tracking_number',
        'date_shipped',
        'code'
    ];
}
