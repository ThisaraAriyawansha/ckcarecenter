<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medication extends Model
{
    protected $fillable = [
        'client_id',
        'drug_name',
        'dosage',
        'frequency',
        'start_date',
        'end_date',
        'instructions',
        'is_active',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Client relationship
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Medication records relationship
     */
    public function records(): HasMany
    {
        return $this->hasMany(MedicationRecord::class);
    }

    /**
     * Get frequency display name
     */
    public function getFrequencyNameAttribute(): string
    {
        return match($this->frequency) {
            'morning' => 'Morning Only',
            'afternoon' => 'Afternoon Only',
            'evening' => 'Evening Only',
            'morning_afternoon' => 'Morning & Afternoon',
            'morning_evening' => 'Morning & Evening',
            'afternoon_evening' => 'Afternoon & Evening',
            'all_three' => 'Three Times Daily',
            default => $this->frequency,
        };
    }
}
