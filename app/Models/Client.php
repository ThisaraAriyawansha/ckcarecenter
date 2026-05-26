<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Client extends Model
{
    protected $fillable = [
        'reg_number',
        'image',
        'date',
        'gender',
        'name',
        'age',
        'dob',
        'co_morbidities_risk_factors',
        'complaints',
        'height_cm',
        'weight_kg',
        'bmi',
        'waist_circumference',
        'hip_circumference',
        'officer_in_charge_id',
        'branch_id',
    ];

    protected $casts = [
        'date' => 'date',
        'dob' => 'date',
        'complaints' => 'array',
        'height_cm' => 'decimal:2',
        'weight_kg' => 'decimal:2',
        'bmi' => 'decimal:2',
        'waist_circumference' => 'decimal:2',
        'hip_circumference' => 'decimal:2',
    ];

    /**
     * Officer in Charge (Carer) relationship
     */
    public function officerInCharge(): BelongsTo
    {
        return $this->belongsTo(User::class, 'officer_in_charge_id');
    }

    /**
     * Multiple Guardians relationship
     */
    public function guardians(): BelongsToMany
    {
        return $this->belongsToMany(Guardian::class, 'client_guardian')
            ->withTimestamps();
    }

    /**
     * Branch relationship
     */
    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Doctors assigned to this client
     */
    public function doctors(): BelongsToMany
    {
        return $this->belongsToMany(Doctor::class, 'client_doctor')
            ->withPivot(['assigned_date', 'notes'])
            ->withTimestamps();
    }

    /**
     * Medications assigned to this client
     */
    public function medications()
    {
        return $this->hasMany(Medication::class);
    }

    /**
     * Client outings
     */
    public function outings()
    {
        return $this->hasMany(ClientOuting::class);
    }

    /**
     * Client documents
     */
    public function documents()
    {
        return $this->hasMany(ClientDocument::class);
    }

    /**
     * Daily checklists
     */
    public function dailyChecklists()
    {
        return $this->hasMany(ClientDailyChecklist::class);
    }

    /**
     * Doctor notes for this client
     */
    public function doctorNotes()
    {
        return $this->hasMany(DoctorNote::class);
    }

    /**
     * Payments for this client
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Client meals
     */
    public function meals()
    {
        return $this->hasMany(ClientMeal::class);
    }

    /**
     * Visitor logs for this client
     */
    public function visitors()
    {
        return $this->hasMany(VisitorLog::class);
    }

    /**
     * Invoices & quotations for this client
     */
    public function invoices()
    {
        return $this->hasMany(ClientInvoice::class);
    }
}
