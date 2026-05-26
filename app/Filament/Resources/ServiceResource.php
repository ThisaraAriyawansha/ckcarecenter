<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ServiceResource\Pages;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class ServiceResource extends Resource
{
    protected static ?string $model = Service::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationLabel = 'Services';

    protected static ?string $navigationGroup = 'Frontend Management';

    protected static ?int $navigationSort = 7;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Service Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true)
                            ->afterStateUpdated(function (string $state, callable $set) {
                                $set('title_slug', Str::slug($state));
                            })
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('title_slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(150)
                            ->unique(Service::class, 'title_slug', ignoreRecord: true)
                            ->helperText('Auto-generated from title. You can edit if needed.')
                            ->columnSpan(1),

                        Forms\Components\Textarea::make('description')
                            ->label('Description')
                            ->rows(5)
                            ->maxLength(2000)
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_public')
                            ->label('Public?')
                            ->helperText('If enabled, service is visible on the public website.')
                            ->default(true)
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Image')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Service Image')
                            ->image()
                            ->imageEditor()
                            ->directory('')
                            ->disk('services_public')
                            ->preserveFilenames(false)
                            ->maxSize(2048) // 2MB
                            ->imageResizeTargetWidth(600)
                            ->imageResizeTargetHeight(400)
                            ->getUploadedFileNameForStorageUsing(function ($file): string {
                                $ext = $file->getClientOriginalExtension();
                                $timestamp = now()->format('YmdHis');
                                $random = Str::random(8);
                                return "service_{$timestamp}_{$random}.{$ext}";
                            })
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->disk('services_public')
                    ->label('Image')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->description)
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('title_slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_public')
                    ->label('Public')
                    ->boolean()
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_public')
                    ->label('Public Status')
                    ->placeholder('All')
                    ->trueLabel('Public Only')
                    ->falseLabel('Private Only'),
            ])
            ->actions([
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

    public static function getPages(): array
    {
        return [
            'index'   => Pages\ListServices::route('/'),           // /admin/services
            'create'  => Pages\CreateService::route('/create'),    // /admin/services/create
            'edit'    => Pages\EditService::route('/{record}/edit'), // /admin/services/1/edit
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}