<?php

namespace App\Administartor\Models;

use App\Administartor\Core\Model;

class LogoutModel extends Model{

    private $linkDb;

    public function __construct() {
    }
    
    public function getData() {
        return [];
    }

    public function logout() {
        $_SESSION = [];
        /*
        unset($_SESSION['isAuth']);
        unset($_SESSION['name']);
        unset($_SESSION['email']);
        unset($_SESSION['roleId']);
        */
        session_destroy();
    }
}
