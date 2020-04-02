<?php

namespace Administrator\App\Controllers;

use Administrator\App\Core\Controller;
use Administrator\App\Models\HomeModel;
use Administrator\App\Core\View;

class HomeController extends Controller {
    
    private $model;
    private $view;
            
    function __construct($linkDb) {
        $this->view = new View();
        $this->model = new HomeModel($linkDb);
    }
            
    function indexAction() {
        $data = $this->model->getData();
        $this->view->genView('homeView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
    }
}