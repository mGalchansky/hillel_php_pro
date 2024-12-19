<?php
use App\Controllers\AuthController;
use Core\Router;


Router::get('api/register/{id:\d+}/user/{user_id:\d+}')
    ->controller(AuthController::class)
    ->action('register');
