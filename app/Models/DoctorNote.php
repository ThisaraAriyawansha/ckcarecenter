<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DoctorNote extends Model
{
    protected $fillable = [
        'client_id',
        'doctor_id',
        'branch_id',
        'note_date',
        'notes',
        'created_by',
    ];

    protected $casts = [
        'note_date' => 'date',
    ];

    /**
     * The client this note is for
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * The doctor who provided the note
     */
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }

    /**
     * The branch where the client belongs
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * The user (manager) who created this note
     */
    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
