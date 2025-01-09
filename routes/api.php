<?php
use App\Controllers\AuthController;
use Core\Router;


Router::post('api/register')
    ->controller(AuthController::class)
    ->action('register');

Router::post('api/auth')
    ->controller(AuthController::class)
    ->action('auth');