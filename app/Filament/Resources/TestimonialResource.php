<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class TestimonialResource extends Resource
{
    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-oval-left';

    protected static ?string $navigationLabel = 'Testimonials';

    
    protected static ?string $navigationGroup = 'Frontend Management';

    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Testimonial Details')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('position')
                            ->required()
                            ->maxLength(100)
                            ->columnSpan(1),

                        Forms\Components\Select::make('rating')
                            ->options([
                                1 => '1 Star',
                                2 => '2 Stars',
                                3 => '3 Stars',
                                4 => '4 Stars',
                                5 => '5 Stars',
                            ])
                            ->required()
                            ->default(5)
                            ->native(false)
                            ->columnSpan(1),

                        Forms\Components\Textarea::make('message')
                            ->label('Testimonial Message')
                            ->rows(5)
                            ->maxLength(1500)
                            ->required()
                            ->columnSpanFull(),

                        Forms\Components\Toggle::make('is_public')
                            ->label('Show publicly')
                            ->default(true)
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Photo')
                    ->schema([
                        Forms\Components\FileUpload::make('image_path')
                            ->label('Testimonial Photo')
                            ->image()
                            ->imageEditor()
                            ->directory('')
                            ->disk('testimonial_public')
                            ->preserveFilenames(false)
                            ->maxSize(2048)
                            ->imageResizeTargetWidth(400)
                            ->imageResizeTargetHeight(400)
                            ->getUploadedFileNameForStorageUsing(function ($file): string {
                                $ext = $file->getClientOriginalExtension();
                                $timestamp = now()->format('YmdHis');
                                $random = Str::random(8);
                                return "testimonial_{$timestamp}_{$random}.{$ext}";
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
                    ->disk('testimonial_public')
                    ->label('Photo')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('position')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('message')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->message)
                    ->searchable()
                    ->wrap(),

                Tables\Columns\TextColumn::make('rating')
                    ->formatStateUsing(fn (string $state): string => str_repeat('★', $state) . str_repeat('☆', 5 - $state))
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
            'index'   => Pages\ListTestimonials::route('/'),          // /admin/testimonials
            'create'  => Pages\CreateTestimonial::route('/create'),   // /admin/testimonials/create
            'edit'    => Pages\EditTestimonial::route('/{record}/edit'), // /admin/testimonials/1/edit
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}