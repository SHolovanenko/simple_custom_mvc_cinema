<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

class HomeController extends Controller {
    
    private $view;
            
    function __construct() {
        $this->view = new View();
    }
            
    function indexAction() {
        $data = ['data' => 'This is Home'];
        $this->view->json($data);
    }
}