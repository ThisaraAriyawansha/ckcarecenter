<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayPackage extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'active',
    ];

    // Optional: nice accessor for price display
    public function getFormattedPriceAttribute(): string
    {
        return 'Rs. ' . number_format($this->price, 2);
    }
}