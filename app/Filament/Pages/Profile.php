<?php

namespace App\Filament\Pages;

use Closure;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Facades\Filament;
use Filament\Forms\Components;
use Filament\Forms\Components\Card;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Concerns\InteractsWithForms;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;

class Profile extends Page implements HasForms
{
    use InteractsWithForms, HasPageShield;

    protected static ?string $navigationIcon = 'heroicon-o-user';

    protected static string $view = 'filament.pages.profile';

    protected static ?string $navigationLabel = 'Profile';
    
    protected static ?string $navigationGroup = 'Pengaturan';

    public ?array $data = [];

    public ?array $password = [];

    public function mount(): void
    {
        $this->form->fill(auth()->user()->attributesToArray());
        $this->passwordForm->fill();
    }

    protected function getForms(): array
    {
        return [
            'form',
            'passwordForm',
        ];
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\Card::make('Edit Profile')
                    ->schema([
                        Components\TextInput::make('name')
                            ->label('Nama')
                            ->required()
                            ->maxLength(255),
                        Components\TextInput::make('email')
                            ->email()
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->maxLength(255),
                        Components\TextInput::make('telepon')
                            ->label('Telepon')
                            ->tel()
                            ->required(),
                        Components\Textarea::make('alamat')
                            ->required()
                            ->columnSpanFull(),
                    ])
                    ->columns(2),
            ])
            ->statePath('data')
            ->model(auth()->user());
    }

    protected function passwordForm(Form $form): Form
    {
        return $form
            ->schema([
                Components\Card::make('Ubah Password')
                    ->schema([
                        Components\TextInput::make('current_password')
                            ->label('Password Lama')
                            ->password()
                            ->minLength(8)
                            ->maxLength(20)
                            ->revealable()
                            ->required()
                            ->rules([
                                fn(): Closure => function (string $attribute, $value, Closure $fail) {
                                    if (!Hash::check($value, auth()->user()->password)) {
                                        $fail('Password lama tidak cocok.');
                                    }
                                },
                            ]),
                        Components\TextInput::make('password')
                            ->label('Password Baru')
                            ->password()
                            ->minLength(8)
                            ->maxLength(20)
                            ->dehydrateStateUsing(fn($state): string => Hash::make($state))
                            ->revealable()
                            ->required(),
                        Components\TextInput::make('confirm_password')
                            ->label('Konfirmasi Password Baru')
                            ->password()
                            ->minLength(8)
                            ->maxLength(20)
                            ->revealable()
                            ->required()
                            ->same('password'),
                    ])
                    ->columns(2),
            ])
            ->statePath('password');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('Simpan')
                ->color('primary')
                ->submit('form'),
        ];
    }

    protected function getFormPasswordActions(): array
    {
        return [
            Action::make('Simpan')
                ->color('primary')
                ->submit('passwordForm'),
        ];
    }

    public function update(): void
    {
        $formState = $this->form->getState();
        auth()->user()->update($formState);

        Notification::make()
            ->title('Profile berhasil diperbarui')
            ->success()
            ->send();
    }

    public function updatePassword(): void
    {
        $passwordState = $this->passwordForm->getState();

        auth()->user()->update([
            'password' => $passwordState['password'],
        ]);

        if (request()->hasSession() && array_key_exists('password', $passwordState)) {
            request()->session()->put([
                'password_hash_' . Filament::getAuthGuard() => $passwordState['password'],
            ]);
        }

        Notification::make()
            ->title('Password berhasil diperbarui')
            ->success()
            ->send();

        $this->passwordForm->fill();
    }
}