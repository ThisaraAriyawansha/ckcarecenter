<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class CareerDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'document_type',
        'document_name',
        'file_path',
        'file_name',
        'file_size',
        'mime_type',
        'issue_date',
        'expiry_date',
        'notes',
        'uploaded_by',
    ];

    protected $casts = [
        'issue_date' => 'date',
        'expiry_date' => 'date',
    ];

    /**
     * Get the career that owns the document.
     */
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    /**
     * Get the user who uploaded the document.
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Delete the document file when the model is deleted.
     */
    protected static function booted()
    {
        static::deleting(function ($document) {
            if ($document->file_path && Storage::disk('public')->exists($document->file_path)) {
                Storage::disk('public')->delete($document->file_path);
            }
        });
    }

    /**
     * Get document type labels.
     */
    public static function getDocumentTypeLabels(): array
    {
        return [
            'contract' => 'Employment Contract',
            'dbs_certificate' => 'DBS Certificate',
            'id_proof' => 'ID Proof (Passport/Driving License)',
            'qualification_certificate' => 'Qualification Certificate',
            'training_certificate' => 'Training Certificate',
            'medical_certificate' => 'Medical Certificate',
            'reference_letter' => 'Reference Letter',
            'bank_details' => 'Bank Details',
            'visa' => 'Visa/Work Permit',
            'insurance' => 'Insurance Documents',
            'other' => 'Other',
        ];
    }
}
