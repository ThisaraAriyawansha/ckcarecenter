<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'rating',
        'message',
        'image_path',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'rating'    => 'integer',
    ];
}