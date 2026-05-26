<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogResource\Pages;
use App\Models\Blog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use App\Models\Category;
use App\Models\Tag;

class BlogResource extends Resource
{
    protected static ?string $model = Blog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?string $navigationLabel = 'Blogs';

    protected static ?string $navigationGroup = 'Content Management';

    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Blog Details')
                    ->schema([
                        Forms\Components\TextInput::make('title')
                            ->required()
                            ->maxLength(150)
                            ->live(onBlur: true) // live update on blur
                            ->afterStateUpdated(function ($state, callable $set, $get) {
                                // Only auto-update slug if it wasn't manually changed
                                if (!$get('title_slug') || $get('title_slug') === Str::slug($get('title') ?? '')) {
                                    $set('title_slug', Str::slug($state));
                                }
                            })
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('title_slug')
                            ->label('Slug (Customizable)')
                            ->required()
                            ->maxLength(255)
                            ->unique(Blog::class, 'title_slug', ignoreRecord: true)
                            ->helperText('Auto-generated from title. You can edit it manually.')
                            ->columnSpan(1),

                        Forms\Components\TextInput::make('name')
                            ->label('Author Name')
                            ->maxLength(100)
                            ->columnSpan(1),

                        Forms\Components\DatePicker::make('date')
                            ->label('Post Date')
                            ->native(false)
                            ->displayFormat('Y-m-d')
                            ->default(now())
                            ->columnSpan(1),

                        Forms\Components\Toggle::make('is_public')
                            ->label('Publicly Visible')
                            ->default(true)
                            ->columnSpan(1),

                        Forms\Components\Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->nullable()
                            ->columnSpan(1),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Tags')
                    ->schema([
                        Forms\Components\Select::make('tags')
                            ->multiple()
                            ->relationship('tags', 'name')
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required()
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn ($state, callable $set) => $set('slug', Str::slug($state))),
                                Forms\Components\TextInput::make('slug')
                                    ->required()
                                    ->unique(Tag::class, 'slug', ignoreRecord: true)
                                    ->helperText('Auto-generated, but editable.'),
                            ])
                            ->createOptionUsing(fn (array $data): int => Tag::create($data)->id)
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('Content & Image')
                    ->schema([
                        Forms\Components\RichEditor::make('description')
                            ->label('Description')
                            ->required()
                            ->maxLength(50000)
                            ->toolbarButtons([
                                'bold',
                                'italic',
                                'underline',
                                'strike',
                                'link',
                                'heading',
                                'bulletList',
                                'orderedList',
                                'blockquote',
                                'codeBlock',
                                'undo',
                                'redo',
                            ])
                            ->columnSpanFull(),

                        Forms\Components\FileUpload::make('image_path')
                            ->label('Featured Image')
                            ->image()
                            ->imageEditor()
                            ->directory('')
                            ->disk('blog_public')
                            ->preserveFilenames(false)
                            ->maxSize(2048)
                            ->imageResizeTargetWidth(800)
                            ->imageResizeTargetHeight(400)
                            ->getUploadedFileNameForStorageUsing(function ($file): string {
                                $ext = $file->getClientOriginalExtension();
                                $timestamp = now()->format('YmdHis');
                                $random = Str::random(8);
                                return "blog_{$timestamp}_{$random}.{$ext}";
                            })
                            ->columnSpanFull(),
                    ]),

                Forms\Components\Section::make('SEO Meta')
                    ->schema([
                        Forms\Components\TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(60)
                            ->helperText('Recommended: 50-60 characters')
                            ->columnSpanFull(),

                        Forms\Components\Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(3)
                            ->maxLength(160)
                            ->helperText('Recommended: 150-160 characters')
                            ->columnSpanFull(),

                        Forms\Components\TextInput::make('meta_keywords')
                            ->label('Meta Keywords')
                            ->helperText('Comma-separated, e.g. elderly care, retirement home')
                            ->columnSpanFull(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->disk('blog_public')
                    ->label('Image')
                    ->circular()
                    ->size(60),

                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('title_slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable()
                    ->copyable()
                    ->description(fn ($record) => url('/blog/' . $record->title_slug))
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tags.name')
                    ->label('Tags')
                    ->badge()
                    ->separator(',')
                    ->limit(3)
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('name')
                    ->label('Author')
                    ->searchable(),

                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),

                Tables\Columns\TextColumn::make('description')
                    ->limit(60)
                    ->tooltip(fn ($record) => $record->description)
                    ->searchable()
                    ->wrap()
                    ->html(),

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
                    ->label('Visibility')
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
            ->defaultSort('date', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index'  => Pages\ListBlogs::route('/'),       
            'create' => Pages\CreateBlog::route('/create'),  
            'edit'   => Pages\EditBlog::route('/{record}/edit'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()?->hasRole('admin') ?? false;
    }
}