<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VisitorLog extends Model
{
    protected $fillable = [
        'branch_id',
        'client_id',
        'visit_date',
        'visitor_name',
        'visitor_contact',
        'purpose',
        'time_in',
        'time_out',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'visit_date' => 'date',
        'time_in' => 'datetime:H:i',
        'time_out' => 'datetime:H:i',
    ];

    /**
     * The branch where the visit occurred
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * The user (manager) who created this log
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * The client being visited (if visitor is a relative)
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Calculate total hours of visit
     */
    public function getTotalHoursAttribute(): ?float
    {
        if (!$this->time_in || !$this->time_out) {
            return null;
        }

        $timeIn = \Carbon\Carbon::parse($this->time_in);
        $timeOut = \Carbon\Carbon::parse($this->time_out);

        return round($timeOut->diffInMinutes($timeIn) / 60, 2);
    }
}
