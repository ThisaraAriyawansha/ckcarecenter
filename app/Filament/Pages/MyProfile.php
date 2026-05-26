<?php

namespace App\Filament\Pages;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Support\Facades\Hash;

class MyProfile extends Page implements Forms\Contracts\HasForms
{
    use Forms\Concerns\InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-user-circle';

    protected static string $view = 'filament.pages.my-profile';

    protected static ?string $navigationLabel = 'My Profile';

    protected static ?string $title = 'My Profile';

    protected static ?string $navigationGroup = 'Account';

    public ?array $data = [];

    /**
     * Only show to users who are not admin/manager
     */
    public static function shouldRegisterNavigation(): bool
    {
        return !auth()->user()->canManageUsers();
    }

    public function mount(): void
    {
        $this->form->fill([
            'name' => auth()->user()->name,
            'email' => auth()->user()->email,
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Profile Information')
                    ->schema([
                        Forms\Components\TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        Forms\Components\TextInput::make('email')
                            ->email()
                            ->required()
                            ->unique(ignoreRecord: true, table: 'users', column: 'email')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Forms\Components\Section::make('Change Password')
                    ->schema([
                        Forms\Components\TextInput::make('current_password')
                            ->password()
                            ->label('Current Password')
                            ->required()
                            ->rules(['current_password']),
                        Forms\Components\TextInput::make('new_password')
                            ->password()
                            ->label('New Password')
                            ->required()
                            ->minLength(8)
                            ->same('new_password_confirmation'),
                        Forms\Components\TextInput::make('new_password_confirmation')
                            ->password()
                            ->label('Confirm New Password')
                            ->required()
                            ->minLength(8),
                    ])
                    ->columns(1)
                    ->collapsed(),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $user = auth()->user();
        $user->name = $data['name'];
        $user->email = $data['email'];

        // Update password if provided
        if (!empty($data['current_password']) && !empty($data['new_password'])) {
            if (!Hash::check($data['current_password'], $user->password)) {
                Notification::make()
                    ->title('Current password is incorrect')
                    ->danger()
                    ->send();
                return;
            }

            $user->password = Hash::make($data['new_password']);
        }

        $user->save();

        Notification::make()
            ->title('Profile updated successfully')
            ->success()
            ->send();

        // Clear password fields
        $this->form->fill([
            'name' => $user->name,
            'email' => $user->email,
            'current_password' => null,
            'new_password' => null,
            'new_password_confirmation' => null,
        ]);
    }
}
