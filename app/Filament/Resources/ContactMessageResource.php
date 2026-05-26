<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactMessageResource\Pages;
use App\Models\ContactMessage;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;

class ContactMessageResource extends Resource
{
    protected static ?string $model = ContactMessage::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope-open';

    protected static ?string $navigationGroup = 'Frontend Management';

    protected static ?string $navigationLabel = 'Contact Messages';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Sender Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->disabled()
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->disabled()
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('number')
                            ->tel()
                            ->disabled()
                            ->columnSpan(1),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Message Details')
                    ->schema([
                        Forms\Components\TextInput::make('subject')
                            ->disabled(),

                        Forms\Components\Textarea::make('message')
                            ->rows(10)
                            ->disabled(),

                        Forms\Components\Toggle::make('is_read')
                            ->label('Mark as Read')
                            ->inline(false)
                            ->onColor('success')
                            ->offColor('danger'),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('number')
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('subject')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(fn ($state) => $state),

                Tables\Columns\IconColumn::make('is_read')
                    ->label('Status')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->trueColor('success')
                    ->falseIcon('heroicon-o-clock')
                    ->falseColor('warning')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->label('Received'),
            ])
            ->defaultSort('created_at', 'desc')
            ->filters([
                Tables\Filters\TernaryFilter::make('is_read')
                    ->label('Read Status')
                    ->placeholder('All Messages')
                    ->trueLabel('Read')
                    ->falseLabel('Unread'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),

                Action::make('toggleRead')
                    ->label(fn (ContactMessage $record): string => $record->is_read ? 'Mark Unread' : 'Mark Read')
                    ->icon(fn (ContactMessage $record): string => $record->is_read ? 'heroicon-o-eye-slash' : 'heroicon-o-eye')
                    ->color(fn (ContactMessage $record): string => $record->is_read ? 'warning' : 'success')
                    ->requiresConfirmation()
                    ->action(function (ContactMessage $record) {
                        $record->update(['is_read' => !$record->is_read]);
                    }),

                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('markAsRead')
                    ->label('Mark selected as Read')
                    ->icon('heroicon-o-eye')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn ($records) => $records->each->update(['is_read' => true])),

                Tables\Actions\BulkAction::make('markAsUnread')
                    ->label('Mark selected as Unread')
                    ->icon('heroicon-o-eye-slash')
                    ->color('warning')
                    ->requiresConfirmation()
                    ->action(fn ($records) => $records->each->update(['is_read' => false])),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContactMessages::route('/'),           // /admin/contact-messages
            'view'  => Pages\ViewContactMessage::route('/{record}'),    // /admin/contact-messages/1
            // 'create' => Pages\CreateContactMessage::route('/create'), // ← uncomment only if you really need it
            // 'edit'   => Pages\EditContactMessage::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->latest();
    }
}