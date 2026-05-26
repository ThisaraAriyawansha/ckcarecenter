<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\ClientDocument;
use Illuminate\Support\Facades\Storage;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    protected static ?string $recordTitleAttribute = 'title';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Document Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->label('Document Title')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Care Agreement 2024'),
                        Forms\Components\Select::make('category')
                            ->label('Category')
                            ->options([
                                'Agreement' => 'Agreement',
                                'Letter' => 'Letter',
                                'Medical Record' => 'Medical Record',
                                'ID Document' => 'ID Document',
                                'Insurance' => 'Insurance',
                                'Prescription' => 'Prescription',
                                'Lab Report' => 'Lab Report',
                                'Consent Form' => 'Consent Form',
                                'Other' => 'Other',
                            ])
                            ->required()
                            ->native(false)
                            ->searchable(),
                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(3)
                            ->placeholder('Brief description of the document')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('File Upload')
                    ->schema([
                        Forms\Components\FileUpload::make('file_path')
                            ->label('Upload Document')
                            ->required()
                            ->directory('client-documents')
                            ->visibility('public')
                            ->disk('public')
                            ->acceptedFileTypes(['application/pdf', 'image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                            ->maxSize(10240) // 10MB
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->helperText('Accepted formats: PDF, Images, Word documents. Max size: 10MB')
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Document Details')
                    ->schema([
                        Forms\Components\DatePicker::make('document_date')
                            ->label('Document Date')
                            ->helperText('Date when document was created/signed')
                            ->native(false),
                        Forms\Components\DatePicker::make('expiry_date')
                            ->label('Expiry Date')
                            ->helperText('Leave empty if document does not expire')
                            ->native(false),
                        Forms\Components\Toggle::make('is_confidential')
                            ->label('Mark as Confidential')
                            ->helperText('Restrict access to authorized personnel only')
                            ->default(false),
                        Forms\Components\Textarea::make('notes')
                            ->label('Additional Notes')
                            ->rows(2)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\IconColumn::make('file_type')
                    ->label('Type')
                    ->icon(fn (string $state): string => match($state) {
                        'pdf' => 'heroicon-o-document-text',
                        'doc', 'docx' => 'heroicon-o-document',
                        'jpg', 'jpeg', 'png', 'gif' => 'heroicon-o-photo',
                        default => 'heroicon-o-paper-clip',
                    })
                    ->color(fn (string $state): string => match($state) {
                        'pdf' => 'danger',
                        'doc', 'docx' => 'info',
                        'jpg', 'jpeg', 'png', 'gif' => 'success',
                        default => 'gray',
                    }),
                Tables\Columns\TextColumn::make('title')
                    ->label('Document Title')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('category')
                    ->label('Category')
                    ->badge()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('document_date')
                    ->label('Document Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->label('Expiry')
                    ->date('M d, Y')
                    ->sortable()
                    ->color(fn (ClientDocument $record) => $record->is_expired ? 'danger' : 'gray')
                    ->badge(fn (ClientDocument $record) => $record->is_expired)
                    ->formatStateUsing(fn (ClientDocument $record) => $record->is_expired ? 'Expired' : $record->expiry_date?->format('M d, Y'))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('file_size_formatted')
                    ->label('Size')
                    ->toggleable(),
                Tables\Columns\IconColumn::make('is_confidential')
                    ->label('Confidential')
                    ->boolean()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('uploadedBy.name')
                    ->label('Uploaded By')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Uploaded At')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('category')
                    ->options([
                        'Agreement' => 'Agreement',
                        'Letter' => 'Letter',
                        'Medical Record' => 'Medical Record',
                        'ID Document' => 'ID Document',
                        'Insurance' => 'Insurance',
                        'Prescription' => 'Prescription',
                        'Lab Report' => 'Lab Report',
                        'Consent Form' => 'Consent Form',
                        'Other' => 'Other',
                    ]),
                Tables\Filters\TernaryFilter::make('is_confidential')
                    ->label('Confidential'),
                Tables\Filters\Filter::make('expired')
                    ->query(fn (Builder $query): Builder => $query->whereNotNull('expiry_date')->whereDate('expiry_date', '<', now()))
                    ->label('Expired Documents'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->label('Upload Document')
                    ->mutateFormDataUsing(function (array $data): array {
                        // Set uploaded by
                        $data['uploaded_by'] = auth()->id();

                        // Extract file metadata from file_path
                        if (isset($data['file_path'])) {
                            $data['file_name'] = basename($data['file_path']);
                            $data['file_type'] = pathinfo($data['file_path'], PATHINFO_EXTENSION);

                            // Get file size
                            if (Storage::disk('public')->exists($data['file_path'])) {
                                $data['file_size'] = Storage::disk('public')->size($data['file_path']);
                            }
                        }

                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function (ClientDocument $record) {
                        return Storage::disk('public')->download($record->file_path, $record->file_name);
                    }),
                Tables\Actions\Action::make('view')
                    ->label('View')
                    ->icon('heroicon-o-eye')
                    ->color('info')
                    ->url(fn (ClientDocument $record) => Storage::disk('public')->url($record->file_path))
                    ->openUrlInNewTab(),
                Tables\Actions\EditAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        // Extract file metadata if file was changed
                        if (isset($data['file_path'])) {
                            $data['file_name'] = basename($data['file_path']);
                            $data['file_type'] = pathinfo($data['file_path'], PATHINFO_EXTENSION);

                            // Get file size
                            if (Storage::disk('public')->exists($data['file_path'])) {
                                $data['file_size'] = Storage::disk('public')->size($data['file_path']);
                            }
                        }

                        return $data;
                    }),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('No documents uploaded')
            ->emptyStateDescription('Upload agreements, letters, medical records and other important documents for this client.')
            ->emptyStateIcon('heroicon-o-document-text');
    }
}
