<?php

namespace App\Helpers;

use CodeIgniter\Session\Session;

class AuthHelper
{
    public static function isLoggedIn()
    {
        $session = service('session');
        return $session->has('user_id');
    }
}