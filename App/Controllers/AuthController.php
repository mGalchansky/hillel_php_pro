<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;

class AuthController extends Controller
{
 public function register()
 {
     dd(User::select()->get());
 }
}