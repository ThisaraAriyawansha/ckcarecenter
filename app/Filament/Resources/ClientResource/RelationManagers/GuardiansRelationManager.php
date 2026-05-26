<?php

namespace App\Filament\Resources\ClientResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class GuardiansRelationManager extends RelationManager
{
    protected static string $relationship = 'guardians';

    protected static ?string $title = 'Guardians';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Full Name')
                    ->required()
                    ->maxLength(255),

                Forms\Components\Select::make('relationship')
                    ->label('Relationship to Client')
                    ->options([
                        'Son'      => 'Son',
                        'Daughter' => 'Daughter',
                        'Spouse'   => 'Spouse',
                        'Sibling'  => 'Sibling',
                        'Parent'   => 'Parent',
                        'Relative' => 'Relative',
                        'Other'    => 'Other',
                    ])
                    ->native(false)
                    ->required(),

                Forms\Components\TextInput::make('phone')
                    ->label('Phone Number')
                    ->tel()
                    ->maxLength(20),

                Forms\Components\TextInput::make('email')
                    ->label('Email Address')
                    ->email()
                    ->maxLength(255),

                Forms\Components\TextInput::make('nic')
                    ->label('NIC Number')
                    ->maxLength(20),

                Forms\Components\Textarea::make('address')
                    ->label('Address')
                    ->rows(2)
                    ->columnSpanFull(),
            ])->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('relationship')
                    ->label('Relationship')
                    ->badge()
                    ->color('info'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->default('-'),

                Tables\Columns\TextColumn::make('nic')
                    ->label('NIC')
                    ->searchable()
                    ->default('-'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                Tables\Actions\DetachAction::make()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasRole('admin')),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make()
                        ->visible(fn () => auth()->user()->hasRole('admin')),
                ]),
            ]);
    }
}
