<?php

namespace App\Administartor\Controllers;

use App\Administartor\Core\Controller;
use App\Administartor\Models\HomeModel;
use App\Administartor\Core\View;

class HomeController extends Controller {
    
    private $model;
    private $view;
            
    function __construct($linkDb) {
        $this->view = new View();
        $this->model = new HomeModel($linkDb);
    }
            
    function indexAction() {
        $data = $this->model->getData();
        $this->view->json($data);
    }
}