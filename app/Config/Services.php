<?php

namespace Config;

use CodeIgniter\Config\BaseService;
use CodeIgniter\Shield\Authentication\Authenticators\Session;
use CodeIgniter\Shield\Models\UserModel;

class Services extends BaseService
{
    public static function authentication($getShared = true)
    {
        if ($getShared) {
            return static::getSharedInstance('authentication');
        }

        $userModel = new UserModel();
        return new Session($userModel);
    }
}