<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EnquiryResource\Pages;
use App\Models\Enquiry;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class EnquiryResource extends Resource
{
    protected static ?string $model = Enquiry::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-plus';

    protected static ?string $navigationGroup = 'Enquiries';

    protected static ?string $navigationLabel = 'Manage Enquiries';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Full Name'),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->maxLength(255)
                            ->label('Email Address'),
                        Forms\Components\TextInput::make('phone')
                            ->tel()
                            ->required()
                            ->maxLength(255)
                            ->label('Primary Phone'),
                        Forms\Components\TextInput::make('alternative_phone')
                            ->tel()
                            ->maxLength(255)
                            ->label('Alternative Phone'),
                        Forms\Components\Textarea::make('address')
                            ->rows(3)
                            ->columnSpanFull()
                            ->label('Address'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Enquiry Details')
                    ->schema([
                        Forms\Components\Select::make('joining_potential')
                            ->label('Joining Potential')
                            ->options(Enquiry::getJoiningPotentialLabels())
                            ->required()
                            ->native(false)
                            ->helperText('Select the priority level for this enquiry'),
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options(Enquiry::getStatusLabels())
                            ->default('new')
                            ->required()
                            ->native(false),
                        Forms\Components\DatePicker::make('follow_up_date')
                            ->label('Follow Up Date')
                            ->native(false)
                            ->helperText('Schedule a follow-up date'),
                        Forms\Components\Select::make('handled_by')
                            ->label('Handled By')
                            ->options(User::whereHas('roles', function ($query) {
                                $query->whereIn('name', ['admin', 'manager']);
                            })->pluck('name', 'id'))
                            ->searchable()
                            ->preload()
                            ->helperText('Assign to a staff member'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Textarea::make('requirements')
                            ->label('Requirements')
                            ->rows(3)
                            ->placeholder('What are they looking for?')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('notes')
                            ->label('Notes')
                            ->rows(3)
                            ->placeholder('Any additional notes about this enquiry')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('joining_potential')
                    ->label('Priority')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match($state) {
                        'level_1' => 'Level 1',
                        'level_2' => 'Level 2',
                        'level_3' => 'Level 3',
                        'level_4' => 'Level 4',
                        default => $state,
                    })
                    ->color(fn ($state) => match($state) {
                        'level_1' => 'success',
                        'level_2' => 'warning',
                        'level_3' => 'info',
                        'level_4' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => Enquiry::getStatusLabels()[$state] ?? $state)
                    ->color(fn ($state) => match($state) {
                        'new' => 'info',
                        'contacted' => 'warning',
                        'scheduled' => 'primary',
                        'converted' => 'success',
                        'not_interested' => 'danger',
                        'follow_up' => 'warning',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('follow_up_date')
                    ->label('Follow Up')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('handler.name')
                    ->label('Handled By')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Enquiry Date')
                    ->dateTime('M d, Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('joining_potential')
                    ->label('Priority Level')
                    ->options(Enquiry::getJoiningPotentialLabels())
                    ->multiple(),
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options(Enquiry::getStatusLabels())
                    ->multiple(),
                Tables\Filters\SelectFilter::make('handled_by')
                    ->label('Handled By')
                    ->relationship('handler', 'name')
                    ->searchable()
                    ->preload(),
                Tables\Filters\Filter::make('follow_up_date')
                    ->form([
                        Forms\Components\DatePicker::make('from')
                            ->label('Follow Up From'),
                        Forms\Components\DatePicker::make('until')
                            ->label('Follow Up Until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('follow_up_date', '>=', $date),
                            )
                            ->when(
                                $data['until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('follow_up_date', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEnquiries::route('/'),
            'create' => Pages\CreateEnquiry::route('/create'),
            'view' => Pages\ViewEnquiry::route('/{record}'),
            'edit' => Pages\EditEnquiry::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
