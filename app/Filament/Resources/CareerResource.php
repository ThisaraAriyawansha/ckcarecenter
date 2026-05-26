<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CareerResource\Pages;
use App\Filament\Resources\CareerResource\RelationManagers;
use App\Models\Career;
use App\Models\User;
use App\Models\Branch;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CareerResource extends Resource
{
    protected static ?string $model = Career::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'HR Management';

    protected static ?string $navigationLabel = 'Staff Management';

    protected static ?string $modelLabel = 'Staff';

    protected static ?string $pluralModelLabel = 'Staff';

    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Basic Information')
                    ->schema([
                        Forms\Components\Select::make('user_id')
                            ->label('User Account')
                            ->relationship('user', 'name', function ($query) {
                                $query->whereHas('roles', function ($roleQuery) {
                                    $roleQuery->whereIn('name', ['career', 'manager', 'chef']);
                                });
                            })
                            ->required()
                            ->searchable()
                            ->preload()
                            ->helperText('Link this staff profile to a user account (Career, Manager, or Chef)'),
                        Forms\Components\TextInput::make('employee_id')
                            ->label('Employee ID')
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255)
                            ->placeholder('e.g., EMP-001'),
                        Forms\Components\TextInput::make('full_name')
                            ->label('Full Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\DatePicker::make('date_of_birth')
                            ->label('Date of Birth')
                            ->required()
                            ->native(false)
                            ->maxDate(now()->subYears(16))
                            ->reactive()
                            ->afterStateUpdated(function ($state, callable $set) {
                                if ($state) {
                                    $set('age', now()->diffInYears($state));
                                }
                            }),
                        Forms\Components\TextInput::make('age')
                            ->label('Age')
                            ->numeric()
                            ->disabled()
                            ->dehydrated(),
                        Forms\Components\Select::make('gender')
                            ->label('Gender')
                            ->options(Career::getGenderLabels())
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('nationality')
                            ->label('Nationality')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('national_id_number')
                            ->label('National ID Number')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('passport_number')
                            ->label('Passport Number')
                            ->maxLength(255),
                        Forms\Components\FileUpload::make('profile_photo')
                            ->label('Profile Photo')
                            ->image()
                            ->directory('career-profiles')
                            ->visibility('public')
                            ->imageEditor()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Contact Information')
                    ->schema([
                        Forms\Components\TextInput::make('email')
                            ->label('Email')
                            ->email()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('phone')
                            ->label('Primary Phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('alternative_phone')
                            ->label('Alternative Phone')
                            ->tel()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('city')
                            ->label('City')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('postal_code')
                            ->label('Postal Code')
                            ->maxLength(255),
                        Forms\Components\Textarea::make('current_address')
                            ->label('Current Address')
                            ->required()
                            ->rows(3)
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('permanent_address')
                            ->label('Permanent Address')
                            ->rows(3)
                            ->columnSpanFull()
                            ->helperText('Leave blank if same as current address'),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Emergency Contact')
                    ->schema([
                        Forms\Components\TextInput::make('emergency_contact_name')
                            ->label('Contact Name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emergency_contact_relationship')
                            ->label('Relationship')
                            ->required()
                            ->maxLength(255)
                            ->placeholder('e.g., Spouse, Parent, Sibling'),
                        Forms\Components\TextInput::make('emergency_contact_phone')
                            ->label('Contact Phone')
                            ->tel()
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('emergency_contact_alternative_phone')
                            ->label('Alternative Phone')
                            ->tel()
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Employment Details')
                    ->schema([
                        Forms\Components\DatePicker::make('joining_date')
                            ->label('Joining Date')
                            ->required()
                            ->native(false)
                            ->default(today()),
                        Forms\Components\DatePicker::make('contract_start_date')
                            ->label('Contract Start Date')
                            ->native(false),
                        Forms\Components\DatePicker::make('contract_end_date')
                            ->label('Contract End Date')
                            ->native(false),
                        Forms\Components\Select::make('employment_type')
                            ->label('Employment Type')
                            ->options(Career::getEmploymentTypeLabels())
                            ->default('full_time')
                            ->required()
                            ->native(false),
                        Forms\Components\Select::make('employment_status')
                            ->label('Employment Status')
                            ->options(Career::getEmploymentStatusLabels())
                            ->default('active')
                            ->required()
                            ->native(false),
                        Forms\Components\TextInput::make('job_title')
                            ->label('Job Title')
                            ->maxLength(255)
                            ->placeholder('e.g., Senior Care Assistant'),
                        Forms\Components\TextInput::make('department')
                            ->label('Department')
                            ->maxLength(255),
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->relationship('branch', 'name')
                            ->searchable()
                            ->preload(),
                        Forms\Components\Select::make('supervisor_id')
                            ->label('Supervisor')
                            ->relationship('supervisor', 'name', function ($query) {
                                $query->whereHas('roles', function ($roleQuery) {
                                    $roleQuery->whereIn('name', ['admin', 'manager']);
                                });
                            })
                            ->searchable()
                            ->preload(),
                        Forms\Components\Textarea::make('job_description')
                            ->label('Job Description')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(3),

                Forms\Components\Section::make('Compensation & Banking')
                    ->schema([
                        Forms\Components\TextInput::make('salary')
                            ->label('Salary Amount')
                            ->numeric()
                            ->prefix('LKR')
                            ->step(0.01),
                        Forms\Components\Select::make('salary_type')
                            ->label('Salary Type')
                            ->options(Career::getSalaryTypeLabels())
                            ->default('monthly')
                            ->native(false),
                        Forms\Components\TextInput::make('bank_name')
                            ->label('Bank Name')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bank_account_number')
                            ->label('Account Number')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('bank_branch')
                            ->label('Bank Branch')
                            ->maxLength(255),
                    ])
                    ->columns(2)
                    ->collapsed(),

                Forms\Components\Section::make('Qualifications & Experience')
                    ->schema([
                        Forms\Components\TextInput::make('highest_qualification')
                            ->label('Highest Qualification')
                            ->maxLength(255),
                        Forms\Components\TextInput::make('years_of_experience')
                            ->label('Years of Experience')
                            ->numeric()
                            ->minValue(0),
                        Forms\Components\Textarea::make('certifications')
                            ->label('Certifications')
                            ->rows(3)
                            ->placeholder('List all relevant certifications')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('specialized_training')
                            ->label('Specialized Training')
                            ->rows(3)
                            ->placeholder('e.g., Dementia care, Manual handling')
                            ->columnSpanFull(),
                        Forms\Components\Textarea::make('previous_employment')
                            ->label('Previous Employment History')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsed(),

                Forms\Components\Section::make('Additional Information')
                    ->schema([
                        Forms\Components\TextInput::make('uniform_size')
                            ->label('Uniform Size')
                            ->maxLength(255),
                        Forms\Components\Toggle::make('has_driving_license')
                            ->label('Has Driving License')
                            ->default(false)
                            ->reactive(),
                        Forms\Components\TextInput::make('driving_license_number')
                            ->label('Driving License Number')
                            ->maxLength(255)
                            ->visible(fn ($get) => $get('has_driving_license')),
                        Forms\Components\DatePicker::make('driving_license_expiry')
                            ->label('License Expiry Date')
                            ->native(false)
                            ->visible(fn ($get) => $get('has_driving_license')),
                        Forms\Components\Toggle::make('has_own_vehicle')
                            ->label('Has Own Vehicle')
                            ->default(false),
                        Forms\Components\Textarea::make('notes')
                            ->label('Additional Notes')
                            ->rows(3)
                            ->columnSpanFull(),
                    ])
                    ->columns(2)
                    ->collapsed(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(function (Builder $query) {
                $user = auth()->user();
                // Managers can only see careers from their branch
                if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                    $query->where('branch_id', $user->branch_id);
                }
            })
            ->columns([
                Tables\Columns\ImageColumn::make('profile_photo')
                    ->label('Photo')
                    ->circular()
                    ->defaultImageUrl(fn ($record) => 'https://ui-avatars.com/api/?name=' . urlencode($record->full_name) . '&color=FFFFFF&background=' . ['3B82F6', '10B981', 'F59E0B', 'EF4444', '06B6D4', '6B7280'][crc32($record->full_name) % 6]),
                Tables\Columns\TextColumn::make('employee_id')
                    ->label('Employee ID')
                    ->searchable()
                    ->sortable()
                    ->copyable(),
                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User Account')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('job_title')
                    ->label('Job Title')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->badge()
                    ->color('primary')
                    ->sortable(),
                Tables\Columns\TextColumn::make('employment_type')
                    ->label('Type')
                    ->formatStateUsing(fn ($state) => Career::getEmploymentTypeLabels()[$state] ?? $state)
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'full_time' => 'success',
                        'part_time' => 'info',
                        'contract' => 'warning',
                        'temporary' => 'gray',
                        default => 'gray',
                    })
                    ->toggleable(),
                Tables\Columns\TextColumn::make('employment_status')
                    ->label('Status')
                    ->formatStateUsing(fn ($state) => Career::getEmploymentStatusLabels()[$state] ?? $state)
                    ->badge()
                    ->color(fn ($state) => match($state) {
                        'active' => 'success',
                        'on_leave' => 'warning',
                        'suspended' => 'danger',
                        'terminated' => 'danger',
                        'resigned' => 'gray',
                        default => 'gray',
                    })
                    ->sortable(),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->copyable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('joining_date')
                    ->label('Joined')
                    ->date('M d, Y')
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('branch')
                    ->relationship('branch', 'name', function ($query) {
                        $user = auth()->user();
                        // Managers only see their branch
                        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
                            $query->where('id', $user->branch_id);
                        }
                    })
                    ->searchable()
                    ->preload(),
                Tables\Filters\SelectFilter::make('employment_type')
                    ->options(Career::getEmploymentTypeLabels())
                    ->multiple(),
                Tables\Filters\SelectFilter::make('employment_status')
                    ->options(Career::getEmploymentStatusLabels())
                    ->multiple(),
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\DocumentsRelationManager::class,
            RelationManagers\CompletedChecklistsRelationManager::class,
            RelationManagers\PayslipsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCareers::route('/'),
            'create' => Pages\CreateCareer::route('/create'),
            'view' => Pages\ViewCareer::route('/{record}'),
            'edit' => Pages\EditCareer::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }

    public static function canViewAny(): bool
    {
        return auth()->user()->hasRole('admin');
    }
}
