<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memorandum extends Model
{
    use HasFactory;
    protected $table = 'memorandums'; // Explicitly set the table name

    protected $fillable = [
        'memo_number',
        'name',
        'title_description',
        'memo_date',
        'date_received'
    ];
}
