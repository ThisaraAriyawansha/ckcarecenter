<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientOuting extends Model
{
    protected $fillable = [
        'client_id',
        'date',
        'time_out',
        'time_in',
        'reason',
        'destination',
        'accompanied_by',
        'transport_mode',
        'status',
        'notes',
        'authorized_by',
    ];

    protected $casts = [
        'date' => 'date',
        'time_out' => 'datetime',
        'time_in' => 'datetime',
    ];

    /**
     * Client who went out
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Staff member who accompanied the client
     */
    public function accompaniedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'accompanied_by');
    }

    /**
     * Staff member who authorized the outing
     */
    public function authorizedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'authorized_by');
    }

    /**
     * Calculate duration of the outing
     */
    public function getDurationAttribute(): ?string
    {
        if (!$this->time_in) {
            return null;
        }

        $diff = $this->time_out->diff($this->time_in);

        if ($diff->days > 0) {
            return $diff->format('%d day(s) %h hour(s) %i minute(s)');
        }

        if ($diff->h > 0) {
            return $diff->format('%h hour(s) %i minute(s)');
        }

        return $diff->format('%i minute(s)');
    }
}
