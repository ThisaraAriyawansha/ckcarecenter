<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'title_slug',
        'price_lkr',
        'price_usd',
        'room_type',
        'sharing_capacity',
        'bathroom_type',
        'status',
    ];

    protected $casts = [
        'price_lkr'         => 'decimal:2',
        'price_usd'         => 'decimal:2',
        'sharing_capacity'  => 'integer',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->title_slug)) {
                $model->title_slug = Str::slug($model->title);
            }
        });

        static::updating(function ($model) {
            if ($model->isDirty('title') && empty($model->title_slug)) {
                $model->title_slug = Str::slug($model->title);
            }
        });
    }

    public function features()
    {
        return $this->hasMany(PackageFeature::class);
    }

    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function getFormattedPriceLkrAttribute(): string
    {
        return 'Rs. ' . number_format($this->price_lkr, 0);
    }

    public function getFormattedPriceUsdAttribute(): string
    {
        return '$' . number_format($this->price_usd, 2);
    }

    public static function getStatuses(): array
    {
        return [
            'active'   => 'Active',
            'inactive' => 'Inactive',
            'archived' => 'Archived',
        ];
    }

    public static function getBathroomTypes(): array
    {
        return [
            'ensuite' => 'En-suite',
            'shared'  => 'Shared Outside',
            'mixed'   => 'Mixed (Depends on Location)',
        ];
    }
}