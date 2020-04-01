<?php

namespace Administrator\App\Models;

use Administrator\App\Core\Model;

class LogoutModel extends Model{

    private $linkDb;

    public function __construct() {
        //
    }
    
    public function getData() {
        return [];
    }

    public function logout() {
        $_SESSION = [];
        session_destroy();
    }
}
