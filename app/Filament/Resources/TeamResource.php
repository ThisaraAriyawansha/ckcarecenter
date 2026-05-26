<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TeamResource\Pages;
use App\Models\Team;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TeamResource extends Resource
{
    protected static ?string $model = Team::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationLabel = 'Team Members';

    protected static ?string $navigationGroup = 'Frontend Management';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Team Member Details')
                    ->schema([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255)
                            ->label('Name'),

                        Textarea::make('bio')
                            ->rows(6)
                            ->label('Bio')
                            ->placeholder('Write a short bio about this team member...')
                            ->nullable(),

                        FileUpload::make('image_path')
                            ->label('Profile Image')
                            ->image()
                            ->imageEditor()
                            ->imageEditorAspectRatios([
                                '1:1',
                                '4:3',
                                '16:9',
                            ])
                            ->disk('team_img')          // Custom disk
                            ->directory('/')            // Root of public/team_img
                            ->preserveFilenames()
                            ->maxSize(5120)             // 5MB
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->nullable(),

                        Toggle::make('active')
                            ->label('Active (Visible on website)')
                            ->default(true)
                            ->inline(false),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                ImageColumn::make('image_path')
                    ->disk('team_img')
                    ->height(60)
                    ->width(60)
                    ->rounded()
                    ->defaultImageUrl(asset('images/placeholder-avatar.jpg')) // optional placeholder
                    ->label('Photo'),

                TextColumn::make('name')
                    ->searchable()
                    ->sortable()
                    ->weight(\Filament\Support\Enums\FontWeight::Bold),

                TextColumn::make('bio')
                    ->limit(50)
                    ->tooltip(function (TextColumn $column): ?string {
                        $state = $column->getState();
                        return strlen($state) > 50 ? $state : null;
                    })
                    ->searchable(),

                IconColumn::make('active')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('active')
                    ->label('Status')
                    ->placeholder('All')
                    ->trueLabel('Active Only')
                    ->falseLabel('Inactive Only'),
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
            'index'  => Pages\ListTeams::route('/'),
            'create' => Pages\CreateTeam::route('/create'),
            //'view'   => Pages\ViewTeam::route('/{record}'),
            'edit'   => Pages\EditTeam::route('/{record}/edit'),
        ];
    }
}