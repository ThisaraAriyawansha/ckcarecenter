<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Career extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'employee_id',
        'full_name',
        'date_of_birth',
        'age',
        'gender',
        'nationality',
        'national_id_number',
        'passport_number',
        'email',
        'phone',
        'alternative_phone',
        'current_address',
        'permanent_address',
        'city',
        'postal_code',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'emergency_contact_alternative_phone',
        'joining_date',
        'contract_start_date',
        'contract_end_date',
        'employment_type',
        'employment_status',
        'job_title',
        'job_description',
        'department',
        'branch_id',
        'supervisor_id',
        'salary',
        'salary_type',
        'bank_name',
        'bank_account_number',
        'bank_branch',
        'highest_qualification',
        'certifications',
        'specialized_training',
        'years_of_experience',
        'previous_employment',
        'dbs_check_date',
        'dbs_certificate_number',
        'dbs_expiry_date',
        'medical_check_date',
        'medical_expiry_date',
        'medical_conditions',
        'allergies',
        'induction_completed_date',
        'fire_safety_training_date',
        'first_aid_training_date',
        'manual_handling_training_date',
        'safeguarding_training_date',
        'infection_control_training_date',
        'uniform_size',
        'has_driving_license',
        'driving_license_number',
        'driving_license_expiry',
        'has_own_vehicle',
        'notes',
        'profile_photo',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date',
        'contract_start_date' => 'date',
        'contract_end_date' => 'date',
        'dbs_check_date' => 'date',
        'dbs_expiry_date' => 'date',
        'medical_check_date' => 'date',
        'medical_expiry_date' => 'date',
        'induction_completed_date' => 'date',
        'fire_safety_training_date' => 'date',
        'first_aid_training_date' => 'date',
        'manual_handling_training_date' => 'date',
        'safeguarding_training_date' => 'date',
        'infection_control_training_date' => 'date',
        'driving_license_expiry' => 'date',
        'has_driving_license' => 'boolean',
        'has_own_vehicle' => 'boolean',
        'salary' => 'decimal:2',
    ];

    /**
     * Get the user associated with the career.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the branch associated with the career.
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Get the supervisor associated with the career.
     */
    public function supervisor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'supervisor_id');
    }

    /**
     * Get the documents associated with the career.
     */
    public function documents(): HasMany
    {
        return $this->hasMany(CareerDocument::class);
    }

    /**
     * Get the daily checklists completed by this career staff.
     */
    public function completedChecklists(): HasMany
    {
        return $this->hasMany(ClientDailyChecklist::class, 'completed_by', 'user_id');
    }

    /**
     * Get the payslips for this career staff.
     */
    public function payslips(): HasMany
    {
        return $this->hasMany(Payslip::class);
    }

    /**
     * Get employment type labels.
     */
    public static function getEmploymentTypeLabels(): array
    {
        return [
            'full_time' => 'Full Time',
            'part_time' => 'Part Time',
            'contract' => 'Contract',
            'temporary' => 'Temporary',
        ];
    }

    /**
     * Get employment status labels.
     */
    public static function getEmploymentStatusLabels(): array
    {
        return [
            'active' => 'Active',
            'on_leave' => 'On Leave',
            'suspended' => 'Suspended',
            'terminated' => 'Terminated',
            'resigned' => 'Resigned',
        ];
    }

    /**
     * Get salary type labels.
     */
    public static function getSalaryTypeLabels(): array
    {
        return [
            'hourly' => 'Hourly',
            'daily' => 'Daily',
            'weekly' => 'Weekly',
            'monthly' => 'Monthly',
            'annual' => 'Annual',
        ];
    }

    /**
     * Get gender labels.
     */
    public static function getGenderLabels(): array
    {
        return [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other',
        ];
    }
}
