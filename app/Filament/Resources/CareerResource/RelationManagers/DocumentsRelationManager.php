<?php

namespace App\Filament\Resources\CareerResource\RelationManagers;

use App\Models\CareerDocument;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Storage;

class DocumentsRelationManager extends RelationManager
{
    protected static string $relationship = 'documents';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('document_type')
                    ->label('Document Type')
                    ->options(CareerDocument::getDocumentTypeLabels())
                    ->required()
                    ->native(false)
                    ->searchable(),
                Forms\Components\TextInput::make('document_name')
                    ->label('Document Name')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('e.g., Employment Contract 2024'),
                Forms\Components\FileUpload::make('file_path')
                    ->label('Document File')
                    ->required()
                    ->directory('career-documents')
                    ->visibility('private')
                    ->downloadable()
                    ->openable()
                    ->acceptedFileTypes(['application/pdf', 'image/*', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->maxSize(10240)
                    ->helperText('Accepted formats: PDF, Images, Word documents. Max size: 10MB'),
                Forms\Components\DatePicker::make('issue_date')
                    ->label('Issue Date')
                    ->native(false)
                    ->maxDate(now()),
                Forms\Components\DatePicker::make('expiry_date')
                    ->label('Expiry Date')
                    ->native(false)
                    ->after('issue_date')
                    ->helperText('Leave blank if document does not expire'),
                Forms\Components\Textarea::make('notes')
                    ->label('Notes')
                    ->rows(3)
                    ->columnSpanFull()
                    ->placeholder('Additional information about this document'),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('document_name')
            ->columns([
                Tables\Columns\TextColumn::make('document_type')
                    ->label('Type')
                    ->formatStateUsing(fn ($state) => CareerDocument::getDocumentTypeLabels()[$state] ?? $state)
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'contract' => 'success',
                        'dbs_certificate' => 'warning',
                        'qualification_certificate' => 'info',
                        'training_certificate' => 'info',
                        'medical_certificate' => 'danger',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('document_name')
                    ->label('Document Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->limit(40),
                Tables\Columns\TextColumn::make('issue_date')
                    ->label('Issue Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->label('Expiry Date')
                    ->date('M d, Y')
                    ->sortable()
                    ->color(fn ($state) => $state && $state->isPast() ? 'danger' : ($state && $state->diffInDays(now()) < 30 ? 'warning' : null))
                    ->tooltip(fn ($state) => $state && $state->isPast() ? 'Document expired' : ($state && $state->diffInDays(now()) < 30 ? 'Expires soon' : null))
                    ->toggleable(),
                Tables\Columns\TextColumn::make('uploader.name')
                    ->label('Uploaded By')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Upload Date')
                    ->dateTime('M d, Y H:i')
                    ->sortable()
                    ->toggleable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('document_type')
                    ->options(CareerDocument::getDocumentTypeLabels())
                    ->multiple(),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['uploaded_by'] = auth()->id();
                        return $data;
                    }),
            ])
            ->actions([
                Tables\Actions\Action::make('download')
                    ->label('Download')
                    ->icon('heroicon-o-arrow-down-tray')
                    ->color('success')
                    ->action(function ($record) {
                        return Storage::disk('public')->download($record->file_path, $record->document_name);
                    }),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->emptyStateHeading('No documents uploaded')
            ->emptyStateDescription('Upload employment contracts, certificates, and other documents for this career staff.')
            ->emptyStateIcon('heroicon-o-document');
    }
}
