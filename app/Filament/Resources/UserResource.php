<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'HR Management';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('User Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true)
                            ->maxLength(255),
                        Forms\Components\TextInput::make('password')
                            ->password()
                            ->required(fn (string $context): bool => $context === 'create')
                            ->dehydrated(fn ($state) => filled($state))
                            ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                            ->maxLength(255)
                            ->helperText(fn (string $context): string => $context === 'edit' ? 'Leave blank to keep current password' : ''),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Role & Branch Assignment')
                    ->schema([
                        Forms\Components\Select::make('role')
                            ->label('User Role')
                            ->options(function () {
                                $user = auth()->user();
                                $allRoles = [
                                    'admin' => 'Admin',
                                    'manager' => 'Manager',
                                    'career' => 'Career',
                                    'chef' => 'Chef',
                                    'user' => 'User',
                                ];

                                // If user is Manager, hide Admin role option
                                if ($user && $user->hasRole('manager') && !$user->hasRole('admin')) {
                                    unset($allRoles['admin']);
                                }

                                return $allRoles;
                            })
                            ->required()
                            ->native(false)
                            ->helperText('Admin has full access. Manager can manage Career, Chef, and User roles.')
                            ->afterStateHydrated(function (Forms\Components\Select $component, $record) {
                                if ($record) {
                                    $component->state($record->roles->first()?->name);
                                }
                            })
                            ->dehydrated(false),
                        Forms\Components\Select::make('branch_id')
                            ->label('Branch')
                            ->relationship('branch', 'name', fn ($query) => $query->where('is_active', true))
                            ->default(function () {
                                $currentUser = auth()->user();
                                // If manager (not admin), default to their branch
                                if ($currentUser && $currentUser->hasRole('manager') && !$currentUser->hasRole('admin')) {
                                    return $currentUser->branch_id;
                                }
                                return null;
                            })
                            ->disabled(function () {
                                $currentUser = auth()->user();
                                // Managers can't change the branch - it's always their branch
                                return $currentUser && $currentUser->hasRole('manager') && !$currentUser->hasRole('admin');
                            })
                            ->dehydrated()
                            ->searchable()
                            ->preload()
                            ->helperText(function () {
                                $currentUser = auth()->user();
                                if ($currentUser && $currentUser->hasRole('manager') && !$currentUser->hasRole('admin')) {
                                    return 'Users will be assigned to your branch automatically';
                                }
                                return 'Assign user to a branch';
                            }),
                    ])
                    ->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('roles.name')
                    ->label('Role')
                    ->badge()
                    ->colors([
                        'danger' => 'admin',
                        'warning' => 'manager',
                        'success' => 'career',
                        'info' => 'chef',
                        'gray' => 'user',
                    ])
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('branch.name')
                    ->label('Branch')
                    ->badge()
                    ->color('primary')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->label('Verified')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Joined')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('role')
                    ->relationship('roles', 'name')
                    ->label('Filter by Role')
                    ->multiple()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->visible(fn (User $record) => auth()->user()->isAdmin() ||
                        (auth()->user()->isManager() && !$record->hasRole('admin'))),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()
                        ->visible(fn () => auth()->user()->canManageUsers()),
                ]),
            ]);
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    /**
     * Control who can see the User resource in navigation
     */
    public static function canViewAny(): bool
    {
        return auth()->user()->canManageUsers();
    }

    /**
     * Query to filter users based on role permissions
     */
    public static function getEloquentQuery(): Builder
    {
        $query = parent::getEloquentQuery();

        $user = auth()->user();

        // Managers can only see their own profile plus career, chef, and regular users from their branch (not admins or other managers)
        if ($user->hasRole('manager') && !$user->hasRole('admin')) {
            $query->where(function ($q) use ($user) {
                // Show logged-in manager's own profile
                $q->where('id', $user->id)
                    // OR show career, chef, and regular users from the same branch
                    ->orWhere(function ($branchQuery) use ($user) {
                        $branchQuery->where('branch_id', $user->branch_id)
                            ->whereHas('roles', function ($roleQuery) {
                                $roleQuery->whereIn('name', ['career', 'chef', 'user']);
                            });
                    });
            });
        }

        return $query;
    }
}
