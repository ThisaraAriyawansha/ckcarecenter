<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Filament\Resources\ClientResource\RelationManagers;
use App\Models\Client;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Client Management';

    protected static ?string $navigationLabel = 'Clients';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Client Photo')
                            ->image()
                            ->imageEditor()
                            ->imageEditorMode(2)
                            ->imageEditorAspectRatios([
                                null,
                                '1:1',
                                '4:3',
                                '16:9',
                            ])
                            ->imageEditorViewportWidth('1024')
                            ->imageEditorViewportHeight('1024')
                            ->imageResizeMode('cover')
                            ->imageCropAspectRatio('1:1')
                            ->imageResizeTargetWidth('1024')
                            ->imageResizeTargetHeight('1024')
                            ->directory('clients')
                            ->visibility('public')
                            ->disk('public')
                            ->maxSize(5120)
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/gif'])
                            ->downloadable()
                            ->openable()
                            ->previewable()
                            ->imagePreviewHeight('250')
                            ->uploadingMessage('Uploading photo...')
                            ->helperText('Upload a client photo. Click to crop/edit. Max 5MB. Recommended: 1024x1024px')
                            ->columnSpanFull(),
                        Forms\Components\TextInput::make('reg_number')
                            ->label('Registration Number')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('date')
                            ->label('Registration Date')
                            ->required()
                            ->default(now()),
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\Select::make('gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                            ])
                            ->required()
                            ->native(false),
                        Forms\Components\DatePicker::make('dob')
                            ->label('Date of Birth')
                            ->required()
                            ->maxDate(now())
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $age = \Carbon\Carbon::parse($state)->age;
                                    $set('age', $age);
                                }
                            }),
                        Forms\Components\TextInput::make('age')
                            ->required()
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Health Information')
                    ->schema([
                        Forms\Components\Textarea::make('co_morbidities_risk_factors')
                            ->label('Co-Morbidities & Risk Factors')
                            ->rows(4)
                            ->columnSpanFull(),
                        Forms\Components\Repeater::make('complaints')
                            ->label('Complaints')
                            ->schema([
                                Forms\Components\DatePicker::make('date')
                                    ->label('Date')
                                    ->required()
                                    ->default(now()),
                                Forms\Components\Textarea::make('complaint')
                                    ->label('Complaint Details')
                                    ->required()
                                    ->rows(3)
                                    ->columnSpanFull(),
                            ])
                            ->defaultItems(0)
                            ->addActionLabel('Add Complaint')
                            ->collapsible()
                            ->collapsed()
                            ->itemLabel(fn (array $state): ?string => $state['date'] ?? null)
                            ->columnSpanFull()
                            ->columns(2),
                    ]),

                Forms\Components\Section::make('Physical Measurements')
                    ->schema([
                        Forms\Components\TextInput::make('height_cm')
                            ->label('Height (CM)')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('cm')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $weight = $get('weight_kg');
                                if ($state && $weight) {
                                    $heightInMeters = $state / 100;
                                    $bmi = $weight / ($heightInMeters * $heightInMeters);
                                    $set('bmi', round($bmi, 2));
                                }
                            }),
                        Forms\Components\TextInput::make('weight_kg')
                            ->label('Weight (KG)')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('kg')
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $get, callable $set) {
                                $height = $get('height_cm');
                                if ($state && $height) {
                                    $heightInMeters = $height / 100;
                                    $bmi = $state / ($heightInMeters * $heightInMeters);
                                    $set('bmi', round($bmi, 2));
                                }
                            }),
                        Forms\Components\TextInput::make('bmi')
                            ->label('BMI')
                            ->numeric()
                            ->disabled()
                            ->dehydrated()
                            ->helperText('Automatically calculated from height and weight'),
                        Forms\Components\TextInput::make('waist_circumference')
                            ->label('Waist Circumference (CM)')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('cm'),
                        Forms\Components\TextInput::make('hip_circumference')
                            ->label('Hip Circumference (CM)')
                            ->numeric()
                            ->step(0.01)
                            ->suffix('cm'),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Branch & Care Assignment')
                    ->schema([
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->relationship('branch', 'name', function ($query) {
                                $user = auth()->user();
                                $query->where('is_active', true);

                                // Career and manager users can only select their own branch
                                if ($user->hasRole('career') || $user->hasRole('manager')) {
                                    $query->where('id', $user->branch_id);
                                }
                            })
                            ->searchable()
                            ->preload()
                            ->required()
                            ->default(function () {
                                $user = auth()->user();
                                // Auto-select branch for career and manager users
                                if ($user->hasRole('career') || $user->hasRole('manager')) {
                                    return $user->branch_id;
                                }
                                return null;
                            })
                            ->disabled(fn () => auth()->user()->hasRole('career') || auth()->user()->hasRole('manager'))
                            ->dehydrated()
                            ->helperText('Assign client to a branch'),
                        Forms\Components\Select::make('officer_in_charge_id')
                            ->label('Officer in Charge (Carer)')
                            ->options(function (callable $get) {
                                $branchId = $get('branch_id');

                                return User::whereHas('roles', function ($query) {
                                    $query->where('name', 'career');
                                })
                                ->when($branchId, function ($query) use ($branchId) {
                                    $query->where('branch_id', $branchId);
                                })
                                ->pluck('name', 'id');
                            })
                            ->searchable()
                            ->preload()
                            ->reactive()
                            ->helperText('Select a carer to be responsible for this client'),
                        Forms\Components\Select::make('doctors')
                            ->label('Assigned Doctors')
                            ->relationship('doctors', 'name', fn ($query) => $query->where('is_active', true))
                            ->multiple()
                            ->searchable()
                            ->preload()
                            ->helperText('Select one or more doctors for this client')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();

                // If user is a career staff, only show clients from their branch
                if ($user->hasRole('career')) {
                    $query->where('branch_id', $user->branch_id);
                }

                // Managers also see only their branch clients
                if ($user->hasRole('manager')) {
                    $query->where('branch_id', $user->branch_id);
                }

                // Admins see all clients (no filter)
            })
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Photo')
                    ->circular()
                    ->size(60)
                    ->defaultImageUrl(function ($record) {
                        // Generate avatar with initials and color based on name
                        return 'https://ui-avatars.com/api/?' . http_build_query([
                            'name' => $record->name,
                            'color' => 'FFFFFF',
                            'background' => substr(md5($record->name), 0, 6),
                            'font-size' => 0.4,
                            'bold' => true,
                            'length' => 2,
                            'rounded' => true,
                        ]);
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('reg_number')
                    ->label('Reg. Number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('gender')
                    ->badge()
                    ->colors([
                        'info' => 'male',
                        'danger' => 'female',
                        'gray' => 'other',
                    ])
                    ->formatStateUsing(fn (string $state): string => ucfirst($state)),
                Tables\Columns\TextColumn::make('age')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('dob')
                    ->label('Date of Birth')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('bmi')
                    ->label('BMI')
                    ->numeric()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('officerInCharge.name')
                    ->label('Officer in Charge')
                    ->sortable()
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('doctors.name')
                    ->label('Doctors')
                    ->badge()
                    ->color('success')
                    ->separator(',')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('guardians.name')
                    ->label('Guardians')
                    ->badge()
                    ->separator(',')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('date')
                    ->label('Registration Date')
                    ->date()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('branch')
                    ->relationship('branch', 'name')
                    ->label('Branch')
                    ->preload(),
                Tables\Filters\SelectFilter::make('gender')
                    ->options([
                        'male' => 'Male',
                        'female' => 'Female',
                        'other' => 'Other',
                    ]),
                Tables\Filters\SelectFilter::make('officer_in_charge')
                    ->relationship('officerInCharge', 'name')
                    ->label('Officer in Charge')
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\Action::make('generate_invoice')
                    ->label('Invoice')
                    ->icon('heroicon-o-document-text')
                    ->color('success')
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager']))
                    ->url(fn (Client $record) => ClientResource::getUrl('generate-invoice', ['record' => $record])),

                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->hasAnyRole(['admin', 'manager'])),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        $user = auth()->user();
        $isCareer = $user && $user->hasRole('career') && !$user->hasAnyRole(['admin', 'manager']);

        $relations = [
            RelationManagers\DailyChecklistsRelationManager::class,
            RelationManagers\MealsRelationManager::class,
            RelationManagers\MedicationsRelationManager::class,
            RelationManagers\OutingsRelationManager::class,
        ];

        // Only admin and manager can see doctor notes, documents, payments, and visitors
        if (!$isCareer) {
            $relations[] = RelationManagers\GuardiansRelationManager::class;
            $relations[] = RelationManagers\DoctorNotesRelationManager::class;
            $relations[] = RelationManagers\DocumentsRelationManager::class;
            $relations[] = RelationManagers\InvoicesRelationManager::class;
            $relations[] = RelationManagers\PaymentsRelationManager::class;
            $relations[] = RelationManagers\VisitorsRelationManager::class;
        }

        return $relations;
    }

    public static function getPages(): array
    {
        return [
            'index'            => Pages\ListClients::route('/'),
            'create'           => Pages\CreateClient::route('/create'),
            'edit'             => Pages\EditClient::route('/{record}/edit'),
            'generate-invoice' => Pages\GenerateInvoice::route('/{record}/invoice'),
        ];
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasAnyRole(['admin', 'manager', 'career']);
    }
}
