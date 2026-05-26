<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CareerAttendance extends Model
{
    protected $fillable = [
        'user_id',
        'branch_id',
        'date',
        'time_in',
        'time_out',
        'status',
        'approved_by',
        'approved_at',
        'notes',
        'manager_notes',
    ];

    protected $casts = [
        'date' => 'date',
        'time_in' => 'datetime:H:i',
        'time_out' => 'datetime:H:i',
        'approved_at' => 'datetime',
    ];

    /**
     * The career who submitted the attendance
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The branch where the career works
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * The manager who approved the attendance
     */
    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Get the badge color based on status
     */
    public function getStatusColorAttribute(): string
    {
        return match ($this->status) {
            'approved' => 'success',
            'rejected' => 'danger',
            'pending' => 'warning',
            default => 'gray',
        };
    }

    /**
     * Calculate total hours worked
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
