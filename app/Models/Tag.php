<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function blogs()
    {
        return $this->belongsToMany(Blog::class);
    }

    protected static function booted()
    {
        static::creating(function ($tag) {
            if ($tag->name && !$tag->slug) {
                $tag->slug = static::generateUniqueSlug($tag->name);
            }
        });

        static::updating(function ($tag) {
            if ($tag->isDirty('name') && !$tag->isDirty('slug')) {
                $tag->slug = static::generateUniqueSlug($tag->name, $tag->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $slug = Str::slug($name);
        $original = $slug;
        $count = 1;

        while (static::where('slug', $slug)->where('id', '!=', $ignoreId)->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}