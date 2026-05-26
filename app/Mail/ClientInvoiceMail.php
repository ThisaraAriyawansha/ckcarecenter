<?php

namespace App\Mail;

use App\Models\Client;
use App\Models\Guardian;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ClientInvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Client   $client,
        public Guardian $guardian,
        public array    $invoiceData,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice - ' . $this->client->name . ' - CARE 365',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.client-invoice',
        );
    }

    public function attachments(): array
    {
        $pdf = Pdf::loadView('pdf.client-invoice', $this->invoiceData)->setPaper('a4');

        $filename = 'invoice-' . str_replace(' ', '-', strtolower($this->client->name)) . '-' . now()->format('Ymd') . '.pdf';

        return [
            Attachment::fromData(fn () => $pdf->output(), $filename)
                ->withMime('application/pdf'),
        ];
    }
}
