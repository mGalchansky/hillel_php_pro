<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use ReallySimpleJWT\Jwt;
use ReallySimpleJWT\Token;

class BaseApiController extends Controller
{
    public function before(string $action, array $params = []): bool
    {
        $token = getAuthToken();
        $user = User::findBy('token', $token);

        if (!$user || !Token::validate($token, $user->password)) {
            throw new \Exception("Invalid token", 422);
        }

        $payload = Token::getPayload($token);

        if(!empty($payload['exp']) && $payload['exp'] < $user->token_expired_at) {
            throw new \Exception("Expired token", 422);
        }

        return true;
    }
}