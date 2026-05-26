<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image_path',
        'title_slug',
        'is_public',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    // Optional: Auto-generate slug before saving (but we'll handle in Filament for form)
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['title_slug'] = Str::slug($value);
    }
}