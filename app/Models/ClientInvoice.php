<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ClientInvoice extends Model
{
    protected $fillable = [
        'client_id',
        'branch_id',
        'invoice_number',
        'type',
        'invoice_date',
        'subtotal',
        'discount',
        'total',
        'remarks',
        'bank_ac_name',
        'bank_ac_number_lkr',
        'bank_ac_number_usd',
        'bank_name',
        'bank_branch',
        'email_sent',
        'email_sent_at',
        'created_by',
    ];

    protected $casts = [
        'invoice_date' => 'date',
        'subtotal'     => 'decimal:2',
        'discount'     => 'decimal:2',
        'total'        => 'decimal:2',
        'email_sent'   => 'boolean',
        'email_sent_at' => 'datetime',
    ];

    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(ClientInvoiceItem::class, 'invoice_id')->orderBy('sort_order');
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function recalculateTotals(): void
    {
        $subtotal = $this->items()->sum('price');
        $discount = $this->items()->sum('discount');
        $total    = $this->items()->sum('amount');

        $this->update([
            'subtotal' => $subtotal,
            'discount' => $discount,
            'total'    => $total,
        ]);
    }

    public static function generateInvoiceNumber(): string
    {
        $year     = now()->format('Y');
        $sequence = static::whereYear('created_at', $year)->count() + 1;
        return 'INV-' . $year . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }
}
