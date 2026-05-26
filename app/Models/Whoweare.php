<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whoweare extends Model
{
    use HasFactory;

    protected $table = 'whoweares'; 

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'display_order',
        'is_public',
    ];

    protected $casts = [
        'is_public'     => 'boolean',
        'display_order' => 'integer',
    ];
}