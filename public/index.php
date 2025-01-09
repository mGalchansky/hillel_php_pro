<?php

use App\Enums\Http\Status;
use App\Enums\SQL;
use App\Models\User;
use Core\Router;
use Dotenv\Dotenv;

define('BASE_DIR', dirname(__DIR__));
require_once BASE_DIR . '/vendor/autoload.php';


try {
    $dotenv = Dotenv::createUnsafeImmutable(BASE_DIR);
    $dotenv->load();

    require_once BASE_DIR . '/routes/api.php';
    die(Router::dispatch($_SERVER['REQUEST_URI']));
} catch (Throwable $exception) {

    if (is_string($exception->getCode())) {
        //die($exception->getMessage());
       // dd($exception);
    } else {
        die(
        jsonResponse(
            Status::tryFrom($exception->getCode()) ?? Status::UNPROCESSABLE_ENTITY,
            [
                'errors' => [
                    'message' => $exception->getMessage(),
                    'trace' => $exception->getTrace(),
                ]
            ]
        )
        );
    }
}