<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareHome extends Model
{
    use HasFactory;

    protected $table = 'care_homes';

    protected $fillable = [
        'title',
        'subtitle',
        'location',
        'description',
        'image_path',
        'contact_no',
        'badge_text',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];
}