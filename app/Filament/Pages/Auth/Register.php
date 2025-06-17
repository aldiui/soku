<?php
namespace App\Filament\Pages\Auth;

use App\Models\Role;
use Filament\Forms\Form;
use Filament\Actions\Action;
use Filament\Forms\Components\TextInput;
use Filament\Pages\Auth\Register as BaseRegister;

class Register extends BaseRegister
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getNameFormComponent()->label('Nama'),
                        $this->getEmailFormComponent()->label('Email'),
                        $this->getPasswordFormComponent()->label('Password'),
                        $this->getPasswordConfirmationFormComponent()->label('Konfirmasi Password'),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('registrasi')
                ->color('primary')
                ->icon('heroicon-o-user-plus')
                ->submit('form'),
        ];
    }

    protected function afterRegistration($user): void 
    {
        $userRole = Role::where('name', 'panel_user')->first();
        if ($userRole) {
            $user->assignRole($userRole);
        }
        $firstRole = $user->roles->first();
    }
}