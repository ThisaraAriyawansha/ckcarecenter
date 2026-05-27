<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Models\Guardian;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class PaymentsRelationManager extends RelationManager
{
    protected static string $relationship = 'payments';

    protected static ?string $title = 'Payments';

    // ─── Form ─────────────────────────────────────────────────────────────────

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('payment_type')
                    ->label('Payment Type')
                    ->options([
                        'Monthly Fee'      => 'Monthly Fee',
                        'Medical Expenses' => 'Medical Expenses',
                        'Activity Fee'     => 'Activity Fee',
                        'Special Care'     => 'Special Care',
                        'Equipment'        => 'Equipment',
                        'Other'            => 'Other',
                    ])
                    ->required()
                    ->searchable()
                    ->native(false),

                Forms\Components\DatePicker::make('payment_date')
                    ->label('Payment Date')
                    ->required()
                    ->default(today())
                    ->native(false),

                Forms\Components\TextInput::make('amount')
                    ->label('Amount (LKR)')
                    ->required()
                    ->numeric()
                    ->prefix('LKR')
                    ->minValue(0)
                    ->step(0.01),

                Forms\Components\Textarea::make('description')
                    ->label('Description')
                    ->required()
                    ->rows(3)
                    ->maxLength(65535),
            ]);
    }

    // ─── Table ────────────────────────────────────────────────────────────────

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('payment_type')
            ->columns([
                Tables\Columns\TextColumn::make('payment_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('payment_type')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('amount')
                    ->label('Amount')
                    ->money('LKR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->label('Description')
                    ->limit(50)
                    ->wrap()
                    ->searchable(),

                Tables\Columns\IconColumn::make('email_sent')
                    ->label('Email Sent')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email_sent_at')
                    ->label('Sent At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('Created By')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('payment_date', 'desc')
            ->filters([
                Tables\Filters\Filter::make('payment_date')
                    ->form([
                        Forms\Components\DatePicker::make('date_from')
                            ->label('From Date')
                            ->native(false),
                        Forms\Components\DatePicker::make('date_to')
                            ->label('To Date')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['date_from'],
                                fn (Builder $q, $date) => $q->whereDate('payment_date', '>=', $date),
                            )
                            ->when(
                                $data['date_to'],
                                fn (Builder $q, $date) => $q->whereDate('payment_date', '<=', $date),
                            );
                    }),

                Tables\Filters\SelectFilter::make('payment_type')
                    ->label('Payment Type')
                    ->options([
                        'Monthly Fee'      => 'Monthly Fee',
                        'Medical Expenses' => 'Medical Expenses',
                        'Activity Fee'     => 'Activity Fee',
                        'Special Care'     => 'Special Care',
                        'Equipment'        => 'Equipment',
                        'Other'            => 'Other',
                    ])
                    ->placeholder('All Types'),

                Tables\Filters\TernaryFilter::make('email_sent')
                    ->label('Email Status')
                    ->placeholder('All')
                    ->trueLabel('Sent')
                    ->falseLabel('Not Sent'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(fn () => auth()->user()->hasRole('admin'))
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['branch_id']  = $this->getOwnerRecord()->branch_id;
                        $data['created_by'] = auth()->id();
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('send_email')
                    ->label('Send Receipt')
                    ->icon('heroicon-o-envelope')
                    ->color('success')
                    ->visible(fn (Payment $record) => auth()->user()->hasRole('admin') && !$record->email_sent)
                    ->modalHeading('Send Payment Receipt')
                    ->modalDescription(fn (Payment $record) => 'Select a guardian or enter a custom email to send the receipt for ' . $record->client->name . '.')
                    ->form(fn (Payment $record) => $this->receiptEmailForm($record->client))
                    ->action(function (Payment $record, array $data): void {
                        $this->sendReceiptEmail(collect([$record]), $data, markSent: true);
                    }),

                Tables\Actions\ViewAction::make(),

                Tables\Actions\EditAction::make()
                    ->visible(fn () => auth()->user()->hasRole('admin')),

                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // ── Download combined receipt ──────────────────────────
                    Tables\Actions\BulkAction::make('download_receipt')
                        ->label('Download Receipt')
                        ->icon('heroicon-o-document-arrow-down')
                        ->color('gray')
                        ->deselectRecordsAfterCompletion()
                        ->action(function (Collection $records) {
                            $client = $records->first()->client;

                            $pdf = Pdf::loadView('pdf.payment-receipt', [
                                'payments'          => $records->sortBy('payment_date'),
                                'client_name'       => $client->name,
                                'client_reg_number' => $client->reg_number,
                                'branch_name'       => $records->first()->branch->name ?? null,
                                'guardian_name'     => null,
                                'guardian_email'    => null,
                                'guardian_phone'    => null,
                            ])->setPaper('a4');

                            $ids      = $records->pluck('id')->sort()->implode('-');
                            $filename = 'receipt-' . $ids . '.pdf';

                            return response()->streamDownload(
                                fn () => print($pdf->output()),
                                $filename,
                                ['Content-Type' => 'application/pdf']
                            );
                        }),

                    // ── Send combined receipt by email ─────────────────────
                    Tables\Actions\BulkAction::make('send_receipt_email')
                        ->label('Send Receipt by Email')
                        ->icon('heroicon-o-envelope')
                        ->color('success')
                        ->deselectRecordsAfterCompletion()
                        ->form(fn () => $this->receiptEmailForm($this->getOwnerRecord()))
                        ->action(function (Collection $records, array $data): void {
                            $this->sendReceiptEmail($records->sortBy('payment_date'), $data, markSent: true);
                        }),

                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->hasRole('admin')),
                ]),
            ]);
    }

    // ─── Shared helpers ───────────────────────────────────────────────────────

    private function receiptEmailForm($client): array
    {
        $guardians = Guardian::whereHas('clients', fn ($q) => $q->where('clients.id', $client->id))->get();

        $guardianOptions = $guardians->mapWithKeys(fn ($g) => [
            $g->id => $g->name . ($g->email ? ' — ' . $g->email : ' (no email)'),
        ])->toArray();

        return [
            Forms\Components\Select::make('guardian_id')
                ->label('Select Guardian')
                ->options($guardianOptions)
                ->placeholder('Select a guardian...')
                ->nullable()
                ->live()
                ->helperText('Choose a guardian, or leave empty and use the manual emails below.'),

            Forms\Components\TagsInput::make('custom_emails')
                ->label('Or Enter Emails Manually')
                ->placeholder('Type an email and press Enter')
                ->helperText('Press Enter after each email.')
                ->nestedRecursiveRules(['email']),
        ];
    }

    private function sendReceiptEmail(Collection $payments, array $data, bool $markSent = false): void
    {
        $client         = $payments->first()->client;
        $customEmails   = $data['custom_emails'] ?? [];
        $guardianForPdf = null;
        $guardianEmail  = null;
        $guardianName   = 'Guardian';

        if (!empty($data['guardian_id'])) {
            $guardian = Guardian::find($data['guardian_id']);
            if ($guardian) {
                if (!$guardian->email && empty($customEmails)) {
                    \Filament\Notifications\Notification::make()
                        ->title('Cannot Send Email')
                        ->danger()
                        ->body('The selected guardian has no email. Please enter emails manually.')
                        ->send();
                    return;
                }
                $guardianEmail  = $guardian->email;
                $guardianName   = $guardian->name;
                $guardianForPdf = $guardian;
            }
        }

        $allEmails = collect($customEmails)
            ->merge($guardianEmail ? [$guardianEmail] : [])
            ->filter()
            ->unique()
            ->values()
            ->all();

        if (empty($allEmails)) {
            \Filament\Notifications\Notification::make()
                ->title('No Recipients')
                ->danger()
                ->body('Please select a guardian or enter at least one email address.')
                ->send();
            return;
        }

        $pdfData = [
            'payments'          => $payments,
            'client_name'       => $client->name,
            'client_reg_number' => $client->reg_number,
            'branch_name'       => $payments->first()->branch->name ?? null,
            'guardian_name'     => $guardianForPdf->name ?? $guardianName,
            'guardian_email'    => $guardianForPdf->email ?? null,
            'guardian_phone'    => $guardianForPdf->phone ?? null,
        ];

        $pdf      = Pdf::loadView('pdf.payment-receipt', $pdfData)->setPaper('a4');
        $ids      = $payments->pluck('id')->sort()->implode('-');
        $filename = 'receipt-' . $ids . '.pdf';

        $sent   = [];
        $failed = [];

        $emailBody    = view('emails.payment-receipt', ['guardianName' => $guardianName])->render();
        $pdfOutput    = $pdf->output();

        foreach ($allEmails as $email) {
            try {
                Mail::send([], [], function ($message) use ($email, $emailBody, $pdfOutput, $filename, $client) {
                    $message->to($email)
                        ->subject('Payment Receipt — ' . $client->name . ' | C & K Home Nursing and Care Center')
                        ->html($emailBody)
                        ->attachData($pdfOutput, $filename, ['mime' => 'application/pdf']);
                });
                $sent[] = $email;
            } catch (\Exception $e) {
                $failed[] = $email . ' (' . $e->getMessage() . ')';
            }
        }

        if (!empty($sent) && $markSent) {
            $payments->each(fn ($p) => $p->update([
                'email_sent'    => true,
                'email_sent_at' => now(),
            ]));
        }

        if (!empty($sent)) {
            \Filament\Notifications\Notification::make()
                ->title('Receipt Sent')
                ->success()
                ->body('Sent to: ' . implode(', ', $sent))
                ->send();
        }

        if (!empty($failed)) {
            \Filament\Notifications\Notification::make()
                ->title('Some Emails Failed')
                ->danger()
                ->body('Failed: ' . implode('; ', $failed))
                ->send();
        }
    }
}
