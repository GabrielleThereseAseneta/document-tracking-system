<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advisory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title_description',
        'date_of_advisory',
        'date_received'
    ];
}
