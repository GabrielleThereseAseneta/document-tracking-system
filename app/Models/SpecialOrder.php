<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'so_number',
        'name',
        'title_description',
        'date_of_so',
        'date_received'
    ];
}
