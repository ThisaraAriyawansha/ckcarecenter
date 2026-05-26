<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'code',
        'address',
        'phone',
        'email',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Users assigned to this branch
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Clients assigned to this branch
     */
    public function clients(): HasMany
    {
        return $this->hasMany(Client::class);
    }
}
