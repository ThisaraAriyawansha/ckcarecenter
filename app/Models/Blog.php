<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'date',
        'description',
        'image_path',
        'is_public',
        'title_slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'category_id',
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'date' => 'date',
    ];

    // Relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    protected static function booted()
    {
        static::creating(function ($blog) {
            if ($blog->title && !$blog->title_slug) {
                $blog->title_slug = static::generateUniqueSlug($blog->title);
            }
        });

        static::updating(function ($blog) {
            // Regenerate only if title changed AND slug wasn't manually edited
            if ($blog->isDirty('title') && !$blog->isDirty('title_slug') && $blog->title) {
                $blog->title_slug = static::generateUniqueSlug($blog->title, $blog->id);
            }
        });
    }

    protected static function generateUniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $slug = Str::slug($title);
        $original = $slug;
        $count = 1;

        while (static::where('title_slug', $slug)
            ->where('id', '!=', $ignoreId)
            ->exists()) {
            $slug = $original . '-' . $count++;
        }

        return $slug;
    }
}