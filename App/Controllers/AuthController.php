<?php

namespace App\Controllers;

use Core\Controller;

class AuthController extends Controller
{
 public function register(int $id, int $user_id)
 {
//dd(__METHOD__ , $id ,  $user_id);
    // db()->query("INSERT INTO users (id, user_id) VALUES (:id, :user_id)");
   //  dd(getenv('DB_HOST'));
     return $id;
 }
}