<?php

namespace App\Administartor\Controllers;

use App\Administartor\Core\Controller;
use App\Administartor\Models\LogoutModel;
use App\Administartor\Core\View;

class LogoutController extends Controller {
    
    private $model;
    private $view;
    private $is_auth;
            
    function __construct() {
        $this->model = new LogoutModel();
        $this->view = new View();

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