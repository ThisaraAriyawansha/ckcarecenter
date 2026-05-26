<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Guardian extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'nic',
        'relationship',
        'address',
    ];

    public function clients(): BelongsToMany
    {
        return $this->belongsToMany(Client::class, 'client_guardian')
            ->withTimestamps();
    }
}
