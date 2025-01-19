<?php
use App\Controllers\AuthController;
use Core\Router;


Router::post('api/register')
    ->controller(AuthController::class)
    ->action('register');

Router::post('api/auth')
    ->controller(AuthController::class)
    ->action('auth');

Router::get('api/v1/folders')
    ->controller(\App\Controllers\v1\FoldersController::class)
    ->action('index');