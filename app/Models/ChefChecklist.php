<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ChefChecklist extends Model
{
    protected $fillable = [
        'chef_id',
        'manager_id',
        'date',
        'week_number',
        'month',
        'dining_tasks',
        'kitchen_dinning_tasks',
        'bathroom_tasks',
        'common_area_tasks',
        'chef_signed',
        'chef_signed_at',
        'manager_signed',
        'manager_signed_at',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'dining_tasks' => 'array',
        'kitchen_dinning_tasks' => 'array',
        'bathroom_tasks' => 'array',
        'common_area_tasks' => 'array',
        'chef_signed' => 'boolean',
        'manager_signed' => 'boolean',
        'chef_signed_at' => 'datetime',
        'manager_signed_at' => 'datetime',
    ];

    public function chef(): BelongsTo
    {
        return $this->belongsTo(User::class, 'chef_id');
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    // Helper to get task data structure
    public static function getTaskStructure(): array
    {
        return [
            'dining' => [
                'Wipe down table & chairs',
                'Sweep/ Vacuum floor',
                'Clean windows',
                'Clean baseboards',
                'Set table',
            ],
            'kitchen_dinning' => [
                'Clean kitchen after food preparation',
                'VACUUM / Mop up spills',
                'Wash Dishes',
                'Do laundry & put away cloths',
                'Take out trash',
                'Make & change bed as needed',
                'Wipe down bathroom sink & shower',
                'Clean refrigerator/Toaster/Etc',
                'Sanitize light switch',
                'RETRIEVE mail & help with bill payments',
            ],
            'bathrooms' => [
                'Clean Windows / mirror',
                'Dust & wipe surface',
                'Empty Trash',
                'Make bed',
                'Flip rotate mattress',
            ],
            'common_areas' => [
                'Clean drains',
                'Sanitize Wash basin/toilet',
                'Dust & wipe down light fixtures / ceiling fans',
                'Sweep & mop floors / Clean mirrors',
                'Vacuum under furniture and in corners',
                'TV Lobby / Stair Case / Book Shelves /Pic Frames',
                'Garden /Outside & other service Areas',
                'Reports / Day end sharing to admin group',
            ],
        ];
    }
}
