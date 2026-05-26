<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'order',
        'is_active',
    ];

    protected $casts = [
        'event_date'  => 'date',
        'event_time'  => 'datetime:H:i',
        'is_active'   => 'boolean',
    ];
}