<?php

namespace App\Validation;

use CodeIgniter\Shield\Validation\ValidationRules as ShieldValidationRules;

class AuthValidation extends ShieldValidationRules
{
    public function getRegistrationRules(): array
    {
        $setting = setting('Validation.registration');
        if ($setting !== null) {
            return $setting;
        }

        $usernameRules = $this->config->usernameValidationRules;
        // Supprimer la règle is_unique pour permettre les usernames en double
        // $usernameRules['rules'][] = sprintf('is_unique[%s.username]', $this->tables['users']);

        $emailRules = $this->config->emailValidationRules;
        $emailRules['rules'][] = sprintf(
            'is_unique[%s.secret]',
            $this->tables['identities'],
        );

        $passwordRules = $this->getPasswordRules();
        $passwordRules['rules'][] = 'strong_password[]';

        return [
            'username'         => $usernameRules,
            'email'            => $emailRules,
            'password'         => $passwordRules,
            'password_confirm' => $this->getPasswordConfirmRules(),
        ];
    }

    public function getLoginRules(): array
    {
        return setting('Validation.login') ?? [
            'email'    => $this->config->emailValidationRules,
            'password' => $this->getPasswordRules(),
        ];
    }
}
