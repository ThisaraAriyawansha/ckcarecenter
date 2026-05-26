<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ClientDocument extends Model
{
    protected $fillable = [
        'client_id',
        'title',
        'category',
        'description',
        'file_path',
        'file_name',
        'file_type',
        'file_size',
        'document_date',
        'expiry_date',
        'uploaded_by',
        'is_confidential',
        'notes',
    ];

    protected $casts = [
        'document_date' => 'date',
        'expiry_date' => 'date',
        'is_confidential' => 'boolean',
    ];

    /**
     * Client relationship
     */
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class);
    }

    /**
     * User who uploaded the document
     */
    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Get file size in human-readable format
     */
    public function getFileSizeFormattedAttribute(): string
    {
        if (!$this->file_size) {
            return 'Unknown';
        }

        $units = ['B', 'KB', 'MB', 'GB'];
        $size = $this->file_size;
        $unit = 0;

        while ($size >= 1024 && $unit < count($units) - 1) {
            $size /= 1024;
            $unit++;
        }

        return round($size, 2) . ' ' . $units[$unit];
    }

    /**
     * Check if document is expired
     */
    public function getIsExpiredAttribute(): bool
    {
        if (!$this->expiry_date) {
            return false;
        }

        return $this->expiry_date->isPast();
    }

    /**
     * Get document URL
     */
    public function getUrlAttribute(): string
    {
        return Storage::disk('public')->url($this->file_path);
    }

    /**
     * Delete file when document is deleted
     */
    protected static function booted(): void
    {
        static::deleting(function (ClientDocument $document) {
            if (Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
        });
    }
}
