<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClientInvoiceItem extends Model
{
    protected $fillable = [
        'invoice_id',
        'item_name',
        'description',
        'price',
        'discount',
        'amount',
        'sort_order',
    ];

    protected $casts = [
        'price'    => 'decimal:2',
        'discount' => 'decimal:2',
        'amount'   => 'decimal:2',
    ];

    public function invoice(): BelongsTo
    {
        return $this->belongsTo(ClientInvoice::class, 'invoice_id');
    }
}
