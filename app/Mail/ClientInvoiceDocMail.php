<?php

namespace App\Mail;

use App\Models\ClientInvoice;
use App\Models\Guardian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientInvoiceDocMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public ClientInvoice $invoice,
        public ?Guardian $guardian = null,
    ) {}

    public function envelope(): Envelope
    {
        $label = ucfirst($this->invoice->type);
        return new Envelope(
            subject: $label . ' ' . $this->invoice->invoice_number . ' — ' . $this->invoice->client->name . ' — C & K Home Nursing and Care Center',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.client-invoice-doc',
        );
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdf.client-invoice-doc', [
            'invoice' => $this->invoice,
            'client'  => $this->invoice->client,
            'items'   => $this->invoice->items,
        ])->setPaper('a4');

        $filename = strtolower($this->invoice->type) . '-'
            . str_replace(['/', ' '], '-', $this->invoice->invoice_number)
            . '.pdf';

        return [
            Attachment::fromData(fn () => $pdf->output(), $filename)
                ->withMime('application/pdf'),
        ];
    }
}
