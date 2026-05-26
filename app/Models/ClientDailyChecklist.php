<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientDailyChecklist extends Model
{
    protected $fillable = [
        'client_id',
        'date',
        'category',
        'task_key',
        'task_name',
        'day_of_week',
        'completed',
        'completed_by',
        'completed_at',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    /**
     * Client relationship
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * Career who completed the task
     */
    public function completedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'completed_by');
    }

    /**
     * Get all checklist tasks organized by category
     */
    public static function getChecklistTasks(): array
    {
        return [
            'DRESSING & PERSONAL HYGIENE' => [
                'bath_shower_assistance' => 'Bath/ Shower Assistance',
                'lotion_applied' => 'Lotion applied if needed',
                'teeth_brushing_dental' => 'Teeth brushing & dental Cleaning',
                'shaving_hair_trimming' => 'Shaving & hair trimming',
                'brushing_styling_hair' => 'Brushing/ Styling hair',
                'finger_toenail_care' => 'Finger & toenail care',
                'pick_put_cloths' => 'Pick put cloths',
                'toilet_assistance' => 'Toilet assistance',
                'undergarments_medical_devices' => 'Undergarments & medical devices',
                'change_soiled_clothing' => 'Change soiled clothing if needed',
            ],
            'COMPANIONSHIP' => [
                'play_games' => 'Play games',
                'watch_tv_movies' => 'Watch TV/Movies',
                'encourage_others_visit' => 'Encourage others to visit',
                'go_outside_activities' => 'Go outside or have activities',
                'social_events' => 'Social events',
            ],
            'HEALTH & MEDI MANAGEMENT' => [
                'remind_aid_medication' => 'Remind & aid in taking medication',
                'refill_organize_pills' => 'Refill & organize pills',
                'monitor_document_vitals' => 'Monitor & document vitals etc',
                'assist_home_exercise' => 'Assist with home Exercise or therapy',
                'attend_medical_appointments' => 'Attend medical appointments & update nurse',
            ],
            'EATING & NUTRITION' => [
                'help_do_groceries' => 'Help with or do groceries',
                'prepare_meals_snacks' => 'Prepare meals & snacks',
                'assist_with_eating' => 'Assist with eating',
                'ensure_proper_fluid_intake' => 'Ensure proper daily fluid intake',
                'transport' => 'Transport',
                'taking_pics_update_group' => 'Taking pics of residents and update in group',
                'meditation_vitals_reports' => 'Meditation / Vitals / Reports / Day end sharing to admin group',
            ],
        ];
    }
}
