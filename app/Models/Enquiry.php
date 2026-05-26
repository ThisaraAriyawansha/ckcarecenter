<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Enquiry extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'alternative_phone',
        'address',
        'joining_potential',
        'requirements',
        'notes',
        'status',
        'follow_up_date',
        'handled_by',
    ];

    protected $casts = [
        'follow_up_date' => 'date',
    ];

    /**
     * User who is handling this enquiry
     */
    public function handler(): BelongsTo
    {
        return $this->belongsTo(User::class, 'handled_by');
    }

    /**
     * Get joining potential labels
     */
    public static function getJoiningPotentialLabels(): array
    {
        return [
            'level_1' => 'Level 1 - High Priority',
            'level_2' => 'Level 2 - Medium Priority',
            'level_3' => 'Level 3 - Low Priority',
            'level_4' => 'Level 4 - Very Low Priority',
        ];
    }

    /**
     * Get status labels
     */
    public static function getStatusLabels(): array
    {
        return [
            'new' => 'New',
            'contacted' => 'Contacted',
            'scheduled' => 'Scheduled',
            'converted' => 'Converted',
            'not_interested' => 'Not Interested',
            'follow_up' => 'Follow Up',
        ];
    }
}
