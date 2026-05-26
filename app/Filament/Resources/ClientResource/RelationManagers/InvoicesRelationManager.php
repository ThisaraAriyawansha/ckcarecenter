<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use App\Mail\ClientInvoiceDocMail;
use App\Models\ClientInvoice;
use App\Models\Guardian;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Mail;

class InvoicesRelationManager extends RelationManager
{
    protected static string $relationship = 'invoices';

    protected static ?string $title = 'Invoices';

    // ─── Form ─────────────────────────────────────────────────────────────────

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Invoice Details')
                    ->schema([
                        Forms\Components\Select::make('type')
                            ->label('Document Type')
                            ->options([
                                'invoice'   => 'Invoice',
                                'quotation' => 'Quotation',
                            ])
                            ->default('invoice')
                            ->required()
                            ->native(false),

                        Forms\Components\DatePicker::make('invoice_date')
                            ->label('Date')
                            ->required()
                            ->default(today())
                            ->native(false),

                        Forms\Components\TextInput::make('invoice_number')
                            ->label('Invoice / Quote Number')
                            ->required()
                            ->default(fn () => ClientInvoice::generateInvoiceNumber())
                            ->maxLength(50),

                        Forms\Components\Textarea::make('remarks')
                            ->label('Remarks')
                            ->rows(2)
                            ->placeholder('e.g. Please include your reg no when making the bank transfer')
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Line Items')
                    ->schema([
                        Forms\Components\Repeater::make('items')
                            ->label('')
                            ->relationship()
                            ->schema([
                                Forms\Components\TextInput::make('item_name')
                                    ->label('Item')
                                    ->required()
                                    ->placeholder('e.g. One Month Advance Deposit')
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('description')
                                    ->label('Description / Sub-text')
                                    ->placeholder('e.g. Refundable Deposit - T & C Apply')
                                    ->columnSpan(2),

                                Forms\Components\TextInput::make('price')
                                    ->label('Price (Rs)')
                                    ->numeric()
                                    ->required()
                                    ->default(0)
                                    ->minValue(0)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        $price    = (float) ($get('price') ?? 0);
                                        $discount = (float) ($get('discount') ?? 0);
                                        $set('amount', max(0, round($price - $discount, 2)));
                                    }),

                                Forms\Components\TextInput::make('discount')
                                    ->label('Discount (Rs)')
                                    ->numeric()
                                    ->default(0)
                                    ->minValue(0)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(function (Get $get, Set $set) {
                                        $price    = (float) ($get('price') ?? 0);
                                        $discount = (float) ($get('discount') ?? 0);
                                        $set('amount', max(0, round($price - $discount, 2)));
                                    }),

                                Forms\Components\TextInput::make('amount')
                                    ->label('Amount (Rs)')
                                    ->numeric()
                                    ->default(0)
                                    ->disabled()
                                    ->dehydrated(),
                            ])
                            ->columns(3)
                            ->defaultItems(1)
                            ->addActionLabel('Add Item')
                            ->reorderable('sort_order')
                            ->collapsible()
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Bank Details')
                    ->description('Printed on the invoice. Edit to customise for this document.')
                    ->schema([
                        Forms\Components\TextInput::make('bank_ac_name')
                            ->label('Account Name')
                            ->default('Care 365 Pvt LTD')
                            ->required(),

                        Forms\Components\TextInput::make('bank_ac_number_lkr')
                            ->label('Account No (LKR)')
                            ->default('20410016001643 LKR'),

                        Forms\Components\TextInput::make('bank_ac_number_usd')
                            ->label('Account No (USD)')
                            ->default('20440216001643 USD')
                            ->nullable(),

                        Forms\Components\TextInput::make('bank_name')
                            ->label('Bank')
                            ->default("People's Bank")
                            ->required(),

                        Forms\Components\TextInput::make('bank_branch')
                            ->label('Branch')
                            ->default('Head Quarters Branch')
                            ->required(),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }

    // ─── Table ────────────────────────────────────────────────────────────────

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('invoice_number')
            ->defaultSort('invoice_date', 'desc')
            ->columns([
                Tables\Columns\TextColumn::make('invoice_date')
                    ->label('Date')
                    ->date('M d, Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('invoice_number')
                    ->label('Number')
                    ->searchable()
                    ->copyable(),

                Tables\Columns\BadgeColumn::make('type')
                    ->label('Type')
                    ->colors([
                        'primary' => 'invoice',
                        'warning' => 'quotation',
                    ])
                    ->formatStateUsing(fn ($state) => ucfirst($state)),

                Tables\Columns\TextColumn::make('items_count')
                    ->label('Items')
                    ->counts('items')
                    ->alignCenter(),

                Tables\Columns\TextColumn::make('subtotal')
                    ->label('Sub Total')
                    ->money('LKR')
                    ->sortable(),

                Tables\Columns\TextColumn::make('discount')
                    ->label('Discount')
                    ->money('LKR')
                    ->color('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('total')
                    ->label('Total')
                    ->money('LKR')
                    ->sortable()
                    ->weight('bold'),

                Tables\Columns\IconColumn::make('email_sent')
                    ->label('Email Sent')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email_sent_at')
                    ->label('Sent At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('createdBy.name')
                    ->label('Created By')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('New Invoice / Quotation')
                                        ->mutateFormDataUsing(function (array $data): array {
                        $data['branch_id']  = $this->getOwnerRecord()->branch_id;
                        $data['created_by'] = auth()->id();
                        return $data;
                    })
                    ->after(function (ClientInvoice $record): void {
                        $record->recalculateTotals();
                    }),
            ])
            ->actions([
                // ── Generate PDF ───────────────────────────────────────────
                Tables\Actions\Action::make('generate_pdf')
                    ->label('Generate PDF')
                    ->icon('heroicon-o-document-arrow-down')
                    ->color('gray')
                    ->action(function (ClientInvoice $record) {
                        $pdf = Pdf::loadView('pdf.client-invoice-doc', [
                            'invoice' => $record,
                            'client'  => $record->client,
                            'items'   => $record->items,
                        ])->setPaper('a4');

                        $filename = strtolower($record->type) . '-'
                            . str_replace(['/', ' '], '-', $record->invoice_number)
                            . '.pdf';

                        return response()->streamDownload(
                            fn () => print($pdf->output()),
                            $filename,
                            ['Content-Type' => 'application/pdf']
                        );
                    }),

                // ── Send Email ─────────────────────────────────────────────
                Tables\Actions\Action::make('send_email')
                    ->label('Send Email')
                    ->icon('heroicon-o-envelope')
                    ->color('success')
                    ->modalHeading(fn (ClientInvoice $record) => 'Send ' . ucfirst($record->type) . ' by Email')
                    ->modalDescription(fn (ClientInvoice $record) => 'Select recipients for ' . $record->invoice_number . ' — ' . $record->client->name)
                    ->form(function (ClientInvoice $record): array {
                        $client    = $record->client;
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
                                ->helperText('Choose a guardian, or leave empty and use the manual emails below.'),

                            Forms\Components\TagsInput::make('custom_emails')
                                ->label('Or Enter Emails Manually')
                                ->placeholder('Type an email and press Enter')
                                ->helperText('Add one or more emails. Press Enter after each.')
                                ->nestedRecursiveRules(['email']),
                        ];
                    })
                    ->action(function (ClientInvoice $record, array $data): void {
                        $customEmails    = $data['custom_emails'] ?? [];
                        $guardianEmail   = null;
                        $guardianForMail = null;

                        if (!empty($data['guardian_id'])) {
                            $guardian = Guardian::find($data['guardian_id']);
                            if ($guardian) {
                                if (!$guardian->email && empty($customEmails)) {
                                    \Filament\Notifications\Notification::make()
                                        ->title('Cannot Send Email')
                                        ->danger()
                                        ->body('Selected guardian has no email. Please enter emails manually.')
                                        ->send();
                                    return;
                                }
                                $guardianEmail   = $guardian->email;
                                $guardianForMail = $guardian;
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

                        $sent   = [];
                        $failed = [];

                        foreach ($allEmails as $email) {
                            try {
                                Mail::to($email)->send(
                                    new ClientInvoiceDocMail($record, $guardianForMail)
                                );
                                $sent[] = $email;
                            } catch (\Exception $e) {
                                $failed[] = $email . ' (' . $e->getMessage() . ')';
                            }
                        }

                        if (!empty($sent)) {
                            $record->update([
                                'email_sent'    => true,
                                'email_sent_at' => now(),
                            ]);
                            \Filament\Notifications\Notification::make()
                                ->title('Email Sent')
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
                    }),

                Tables\Actions\EditAction::make()
                                        ->after(function (ClientInvoice $record): void {
                        $record->recalculateTotals();
                    }),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No invoices yet')
            ->emptyStateDescription('Create an invoice or quotation for this client.')
            ->emptyStateIcon('heroicon-o-document-text');
    }
}
