<?php

namespace Administrator\App\Controllers;

use Administrator\App\Core\Controller;
use Administrator\App\Models\LogoutModel;
use Administrator\App\Core\View;

class LogoutController extends Controller {
    
    private $model;
            
    function __construct() {
        $this->model = new LogoutModel();

        $this->logout();
    }
    
    function logout() {
        $this->model->logout();
        header("location: ".ADMIN_PATH."/auth");
    }
            
    function indexAction() {
        header("location: ".ADMIN_PATH."/auth");
    }
}