<?php

namespace Administrator\App\Controllers;

use Administrator\App\Core\Controller;
use Administrator\App\Core\View;
use Administrator\App\Models\AuthModel;
use Exception;

class AuthController extends Controller {
    
    private $model;
    private $view;
    private $userData;
            
    public function __construct($linkDb) {
        $this->model = new AuthModel($linkDb);
        $this->view = new View();
    }

    private function auth() {
        $fields = [
            'email' => ['defaultValue' => null, 'required' => true],
            'password' => ['defaultValue' => null, 'required' => true],
        ];
        
        $this->parseRequest($fields);
        $email = trim($this->request('email'));
        $password = md5(trim($this->request('password')));
        $this->userData = $this->model->login($email, $password);
    }        

    public function indexAction() {
        try {
            $this->auth();
            if ($this->userData['isAuth']) {
                $this->view->json($this->userData);
            } else {
                throw new Exception('Please login to continue.'); 
            }
        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }
}