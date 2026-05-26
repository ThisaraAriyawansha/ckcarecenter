<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Doctor extends Model
{
    protected $fillable = [
        'name',
        'specialization',
        'license_number',
        'phone',
        'email',
        'address',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Clients assigned to this doctor
     */
    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_doctor')
            ->withPivot(['assigned_date', 'notes'])
            ->withTimestamps();
    }
}
