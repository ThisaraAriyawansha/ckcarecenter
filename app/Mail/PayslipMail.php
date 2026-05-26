<?php

namespace App\Mail;

use App\Models\Payslip;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PayslipMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public Payslip $payslip
    ) {}

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Payslip for ' . $this->payslip->month_name . ' ' . $this->payslip->year,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.payslip',
            with: [
                'payslip' => $this->payslip,
                'career' => $this->payslip->career,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdf.payslip', [
            'payslip' => $this->payslip,
            'career' => $this->payslip->career,
        ]);

        return [
            Attachment::fromData(fn () => $pdf->output(), 'payslip-' . $this->payslip->payslip_number . '.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
