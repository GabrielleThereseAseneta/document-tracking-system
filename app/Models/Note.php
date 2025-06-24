<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'note_date', 'start', 'type', 'end'];

    protected $casts = [
        'note_date' => 'datetime',
        'start' => 'datetime',
        'end' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];
}
