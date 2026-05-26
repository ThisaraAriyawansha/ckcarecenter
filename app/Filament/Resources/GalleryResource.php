<?php

namespace App\Filament\Resources;

use App\Filament\Resources\GalleryResource\Pages;
use App\Models\Gallery;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;

class GalleryResource extends Resource
{
    protected static ?string $model = Gallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Gallery';

 
    protected static ?string $navigationGroup = 'Frontend Management';

    protected static ?int $navigationSort = 6;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Gallery Image')
                    ->schema([
                        Forms\Components\TextInput::make('category_name')
                            ->label('Category Name')
                            ->required()
                            ->maxLength(100)
                            ->placeholder('e.g. Events, Team, Nature, Facility, Residents')
                            ->columnSpan(1),

                        Forms\Components\FileUpload::make('image_path')
                            ->label('Image')
                            ->image()
                            ->imageEditor()
                            ->directory('')
                            ->disk('gallery_public')
                            ->preserveFilenames(false)
                            ->maxSize(5120) // 5MB
                            ->imageResizeTargetWidth(1200)
                            ->imageResizeTargetHeight(800)
                            ->getUploadedFileNameForStorageUsing(function ($file): string {
                                $ext = $file->getClientOriginalExtension();
                                $timestamp = now()->format('YmdHis');
                                $random = Str::random(8);
                                return "gallery_{$timestamp}_{$random}.{$ext}";
                            })
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->disk('gallery_public')
                    ->label('Image')
                    ->circular()
                    ->size(80),

                Tables\Columns\TextColumn::make('category_name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Optional: add category filter later if you want
                // Tables\Filters\SelectFilter::make('category_name')->relationship(...)
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
            'index'   => Pages\ListGalleries::route('/'),           // /admin/galleries
            'create'  => Pages\CreateGallery::route('/create'),     // /admin/galleries/create
            'edit'    => Pages\EditGallery::route('/{record}/edit'), // /admin/galleries/1/edit
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}