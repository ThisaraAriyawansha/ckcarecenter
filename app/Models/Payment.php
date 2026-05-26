<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'client_id',
        'branch_id',
        'payment_type',
        'description',
        'amount',
        'payment_date',
        'email_sent',
        'email_sent_at',
        'created_by',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'email_sent' => 'boolean',
        'email_sent_at' => 'datetime',
        'amount' => 'decimal:2',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
