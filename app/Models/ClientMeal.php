<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientMeal extends Model
{
    protected $fillable = [
        'client_id',
        'meal_date',
        'meal_time',
        'meal_type',
        'meal_items',
        'notes',
        'recorded_by',
    ];

    protected $casts = [
        'meal_date' => 'date',
        'meal_time' => 'datetime:H:i',
    ];

    /**
     * The client this meal belongs to
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * The carer who recorded this meal
     */
    public function recordedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'recorded_by');
    }

    /**
     * Get meal type labels
     */
    public static function getMealTypeLabels(): array
    {
        return [
            'breakfast' => 'Breakfast',
            'lunch' => 'Lunch',
            'dinner' => 'Dinner',
            'snack' => 'Snack',
        ];
    }
}
