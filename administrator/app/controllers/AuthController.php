<?php

class AuthController extends Controller {
    
    private $model;
    private $view;
    private $userData;
            
    function __construct($linkDb) {
        $this->model = new AuthModel($linkDb);
        $this->view = new View();
        $this->request();
    }

    function request() {
        if (isset($_POST['email']) && isset($_POST['password'])) {
            $email = trim($_POST['email']);
            $password = md5(trim($_POST['password']));
            $this->userData = $this->model->login($email, $password);
        }
    }        

    function indexAction() {
        $data = $this->model->getData();
        $data['userData'] = $this->userData;
        $this->view->json($data);
    }
}