<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use App\Mail\ClientInvoiceMail;
use App\Models\Client;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\Page;
use Illuminate\Support\Facades\Mail;

class GenerateInvoice extends Page implements HasForms
{
    use InteractsWithForms;

    protected static string $resource = ClientResource::class;
    protected static string $view = 'filament.resources.client-resource.pages.generate-invoice';
    protected static ?string $title = 'Generate Invoice';

    public Client $record;
    public ?array $data = [];

    public function mount(Client $record): void
    {
        $this->record = $record;
        $this->form->fill([
            'date_until'       => today()->toDateString(),
            'payment_types'    => [],
            'guardian_emails'  => [],
            'manual_emails'    => [],
        ]);
    }

    public function form(Form $form): Form
    {
        // Build guardian options (only guardians that have an email)
        $guardianOptions = $this->record
            ->guardians()
            ->whereNotNull('email')
            ->get()
            ->mapWithKeys(fn ($g) => [$g->email => $g->name . ' — ' . $g->email])
            ->toArray();

        return $form
            ->schema([
                Forms\Components\Section::make('Date Range')
                    ->schema([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('From Date')
                            ->native(false)
                            ->live(),
                        Forms\Components\DatePicker::make('date_until')
                            ->label('Until Date')
                            ->native(false)
                            ->live(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Payment Types to Include')
                    ->description('Leave all unchecked to include every type.')
                    ->schema([
                        Forms\Components\CheckboxList::make('payment_types')
                            ->label('')
                            ->options([
                                'Monthly Fee'      => 'Monthly Fee',
                                'Medical Expenses' => 'Medical Expenses',
                                'Activity Fee'     => 'Activity Fee',
                                'Special Care'     => 'Special Care',
                                'Equipment'        => 'Equipment',
                                'Other'            => 'Other',
                            ])
                            ->columns(2)
                            ->columnSpanFull()
                            ->live(),
                    ]),

                Forms\Components\Section::make('Send Invoice by Email')
                    ->schema([
                        // Guardian email checkboxes
                        !empty($guardianOptions)
                            ? Forms\Components\CheckboxList::make('guardian_emails')
                                ->label('Guardian Emails')
                                ->helperText('Select one or more guardians to send the invoice to.')
                                ->options($guardianOptions)
                                ->columns(1)
                                ->columnSpanFull()
                            : Forms\Components\Placeholder::make('no_guardian_emails')
                                ->label('Guardian Emails')
                                ->content(new \Illuminate\Support\HtmlString(
                                    '<span class="text-sm text-gray-400">No guardians with an email address found for this client.</span>'
                                )),

                        // Manual email addresses
                        Forms\Components\TagsInput::make('manual_emails')
                            ->label('Additional Email Addresses')
                            ->helperText('Type an email and press Enter to add it. You can add multiple addresses.')
                            ->placeholder('e.g. example@email.com')
                            ->columnSpanFull(),
                    ]),
            ])
            ->statePath('data');
    }

    public function getPreviewPayments()
    {
        $query = $this->record->payments()->orderBy('payment_date');

        if (!empty($this->data['date_from'])) {
            $query->whereDate('payment_date', '>=', $this->data['date_from']);
        }
        if (!empty($this->data['date_until'])) {
            $query->whereDate('payment_date', '<=', $this->data['date_until']);
        }
        if (!empty($this->data['payment_types'])) {
            $query->whereIn('payment_type', $this->data['payment_types']);
        }

        return $query->get();
    }

    private function noPaymentsNotification(): bool
    {
        $payments = $this->getPreviewPayments();

        if ($payments->isEmpty()) {
            $typeLabel = !empty($this->data['payment_types'])
                ? implode(', ', $this->data['payment_types'])
                : 'any type';

            Notification::make()
                ->title('No Payments Found')
                ->warning()
                ->body('No payments of type "' . $typeLabel . '" were found for the selected date range.')
                ->send();

            return true;
        }

        return false;
    }

    private function buildInvoiceData(): array
    {
        $payments = $this->getPreviewPayments();

        return [
            'client'        => $this->record,
            'payments'      => $payments,
            'total'         => $payments->sum('amount'),
            'guardian'      => $this->record->guardians()->whereNotNull('email')->first(),
            'branch_name'   => $this->record->branch?->name,
            'date_from'     => $this->data['date_from'] ?? null,
            'date_until'    => $this->data['date_until'] ?? null,
            'payment_types' => $this->data['payment_types'] ?? [],
        ];
    }

    public function generatePdf()
    {
        if ($this->noPaymentsNotification()) {
            return;
        }

        $invoiceData = $this->buildInvoiceData();
        $pdf         = Pdf::loadView('pdf.client-invoice', $invoiceData)->setPaper('a4');
        $filename    = 'invoice-' . str_replace(' ', '-', strtolower($this->record->name)) . '-' . now()->format('Ymd') . '.pdf';

        return response()->streamDownload(fn () => print($pdf->output()), $filename, ['Content-Type' => 'application/pdf']);
    }

    public function sendEmail()
    {
        if ($this->noPaymentsNotification()) {
            return;
        }

        $guardianEmails = $this->data['guardian_emails'] ?? [];
        $manualEmails   = array_filter(array_map('trim', $this->data['manual_emails'] ?? []));
        $allEmails      = array_unique(array_merge($guardianEmails, $manualEmails));

        if (empty($allEmails)) {
            Notification::make()
                ->title('No Recipients')
                ->warning()
                ->body('Please select a guardian or enter at least one email address before sending.')
                ->send();

            return;
        }

        $invoiceData = $this->buildInvoiceData();
        $sent        = [];
        $failed      = [];

        foreach ($allEmails as $email) {
            $guardian = $this->record->guardians()->where('email', $email)->first();

            try {
                Mail::to($email)->send(new ClientInvoiceMail($this->record, $guardian, $invoiceData));
                $sent[] = $email;
            } catch (\Exception $e) {
                $failed[] = $email . ' (' . $e->getMessage() . ')';
            }
        }

        if (!empty($sent)) {
            Notification::make()
                ->title('Invoice Sent')
                ->success()
                ->body('Sent to: ' . implode(', ', $sent))
                ->send();
        }

        if (!empty($failed)) {
            Notification::make()
                ->title('Some Emails Failed')
                ->danger()
                ->body('Failed: ' . implode('; ', $failed))
                ->send();
        }
    }

    protected function getHeaderActions(): array
    {
        return [
            \Filament\Actions\Action::make('back')
                ->label('Back to Clients')
                ->icon('heroicon-o-arrow-left')
                ->color('gray')
                ->url(ClientResource::getUrl()),
        ];
    }
}
