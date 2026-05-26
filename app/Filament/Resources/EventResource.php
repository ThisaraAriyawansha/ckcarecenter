<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EventResource\Pages;
use App\Models\Event;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EventResource extends Resource
{
    protected static ?string $model = Event::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-days';

    protected static ?string $navigationGroup = 'Frontend Management';  

    protected static ?string $navigationLabel = 'Events & Activities';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Event Information')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(120)
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('description')
                            ->rows(4)
                            ->maxLength(1000)
                            ->columnSpanFull(),

                        Forms\Components\Grid::make(2)->schema([
                            Forms\Components\DatePicker::make('event_date')
                                ->required()
                                ->native(false)
                                ->displayFormat('d/m/Y'),

                            Forms\Components\TimePicker::make('event_time')
                                ->native(false)
                                ->displayFormat('h:i A'),

                            Forms\Components\TextInput::make('location')
                                ->maxLength(100)
                                ->placeholder('e.g. Garden, TV Lounge, Activity Room'),
                        ]),

                        Forms\Components\Toggle::make('is_active')
                            ->label('Active / Visible to residents')
                            ->default(true),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->limit(50),

                Tables\Columns\TextColumn::make('event_date')
                    ->label('Date')
                    ->date('d M Y')
                    ->sortable(),

                Tables\Columns\TextColumn::make('event_time')
                    ->label('Time')
                    ->time('g:i A')
                    ->sortable(),

                Tables\Columns\TextColumn::make('location')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\IconColumn::make('is_active')
                    ->boolean()
                    ->label('Active'),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active events'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('activate')
                    ->label('Activate')
                    ->icon('heroicon-o-check')
                    ->action(fn ($records) => $records->each->update(['is_active' => true])),
                Tables\Actions\BulkAction::make('deactivate')
                    ->label('Deactivate')
                    ->icon('heroicon-o-x-mark')
                    ->action(fn ($records) => $records->each->update(['is_active' => false])),
            ])
            // Drag & drop ordering
            ->reorderable('order')
            ->defaultSort('event_date', 'asc')
            // ─── Group by Month & Year ────────────────────────────────────────
            ->groups([
                Group::make('event_date')
                    ->getDescriptionFromRecordUsing(fn (Event $record): string => $record->event_date?->format('F Y') ?? 'No date set')
                    ->getKeyFromRecordUsing(fn (Event $record): ?string => $record->event_date?->format('Y-m') ?? 'no-date')
                    ->collapsible()
                    ->date('F Y'),
            ])
            ->defaultGroup('event_date');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListEvents::route('/'),
            'create' => Pages\CreateEvent::route('/create'),
            'edit'   => Pages\EditEvent::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}