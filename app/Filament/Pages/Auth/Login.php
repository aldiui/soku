<?php

namespace App\Filament\Pages\Auth;

use Filament\Forms\Form;
use Filament\Pages\Auth\Login as BaseAuth;
use Filament\Actions\Action;

class Login extends BaseAuth
{
    protected function getForms(): array
    {
        return [
            'form' => $this->form(
                $this->makeForm()
                    ->schema([
                        $this->getEmailFormComponent()->label('Email'),
                        $this->getPasswordFormComponent()->label('Password'),
                    ])
                    ->statePath('data'),
            ),
        ];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('login')
                ->color('primary')
                ->icon('heroicon-o-arrow-right')
                ->submit('form'),
        ];
    }
}