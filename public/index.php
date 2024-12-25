<?php

use App\Enums\SQL;
use Core\Router;
use App\Enums\Http\Status;

define('BASE_DIR', dirname(__DIR__));
require_once BASE_DIR . '/vendor/autoload.php';


try {
    $dotenv = Dotenv\Dotenv::createUnsafeImmutable(BASE_DIR);
    $dotenv->load();

    require_once BASE_DIR . '/routes/api.php';

    dd(\App\Models\User::where('password', SQL::IN, value: 'test')
        ->and('email', value: 'test@gmail.com')
        ->orderBy([
            'created_at' => 'DESC',
            'email' => 'ASC'
        ])
        ->toSql());

    \App\Models\User::where('password', value: 'test');

    die(Router::dispatch($_SERVER['REQUEST_URI']));
} catch (Throwable $exception) {

    die(
    jsonResponse($exception->getCode() === 0 ? Status::UNPROCESSABLE_ENTITY : Status::from($exception->getCode()),
        [
            'error' => [
                'massage' => $exception->getMessage(),
                'trace' => $exception->getTrace()
            ]
        ])
    );
}