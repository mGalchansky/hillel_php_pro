<?php

namespace App\Validators\Auth;

class AuthValidator extends Base
{
    const string DEFAULT_MASSAGE = 'Invalid email or password';
    protected static array $errors = [
        'email' => self::DEFAULT_MASSAGE,
        'password' => self::DEFAULT_MASSAGE
    ];

    public static function validate(array $data = []): bool
    {
        $result = [
            parent::validate($data),
            static::checkEmailOnExists($data['email'], self::DEFAULT_MASSAGE)
        ];

        return !in_array(false, $result);
    }
}