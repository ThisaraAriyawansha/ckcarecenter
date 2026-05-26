<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicationRecord extends Model
{
    protected $fillable = [
        'medication_id',
        'client_id',
        'date',
        'time_of_day',
        'given',
        'given_by',
        'given_at',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'given' => 'boolean',
        'given_at' => 'datetime',
    ];

    /**
     * Medication relationship
     */
    public function medication(): BelongsTo
    {
        return $this->belongsTo(Medication::class);
    }

    /**
     * Client relationship
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Career who gave the medication
     */
    public function givenByUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'given_by');
    }
}
