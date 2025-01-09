<?php

namespace App\Models;

use Core\Model;

class User extends Model
{
    static protected ?string $tableName = 'users';

    public string $email, $password, $created_at;
    public ?string $token_expired_at;
    public ?string $token;

}