<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payslip extends Model
{
    use HasFactory;

    protected $fillable = [
        'career_id',
        'payslip_number',
        'month',
        'year',
        'payment_date',
        'basic_salary',
        'allowances',
        'overtime',
        'bonus',
        'gross_salary',
        'epf_employee',
        'tax',
        'other_deductions',
        'total_deductions',
        'net_salary',
        'status',
        'sent_at',
        'generated_by',
        'notes',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'sent_at' => 'datetime',
        'basic_salary' => 'decimal:2',
        'allowances' => 'decimal:2',
        'overtime' => 'decimal:2',
        'bonus' => 'decimal:2',
        'gross_salary' => 'decimal:2',
        'epf_employee' => 'decimal:2',
        'tax' => 'decimal:2',
        'other_deductions' => 'decimal:2',
        'total_deductions' => 'decimal:2',
        'net_salary' => 'decimal:2',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($payslip) {
            if (!$payslip->payslip_number) {
                $payslip->payslip_number = self::generatePayslipNumber();
            }
        });
    }

    /**
     * Generate unique payslip number
     */
    public static function generatePayslipNumber(): string
    {
        $year = date('Y');
        $month = str_pad(date('m'), 2, '0', STR_PAD_LEFT);
        $lastPayslip = self::where('payslip_number', 'like', "PS-{$year}{$month}%")
            ->orderBy('payslip_number', 'desc')
            ->first();

        if ($lastPayslip) {
            $lastNumber = (int) substr($lastPayslip->payslip_number, -4);
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return "PS-{$year}{$month}{$newNumber}";
    }

    /**
     * Get the career staff member.
     */
    public function career(): BelongsTo
    {
        return $this->belongsTo(Career::class);
    }

    /**
     * Get the user who generated the payslip.
     */
    public function generatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'generated_by');
    }

    /**
     * Get month name
     */
    public function getMonthNameAttribute(): string
    {
        return date('F', mktime(0, 0, 0, $this->month, 1));
    }

    /**
     * Get status labels
     */
    public static function getStatusLabels(): array
    {
        return [
            'draft' => 'Draft',
            'sent' => 'Sent',
            'paid' => 'Paid',
        ];
    }

    /**
     * Scope to filter by month and year
     */
    public function scopeForPeriod($query, int $month, int $year)
    {
        return $query->where('month', $month)->where('year', $year);
    }
}
