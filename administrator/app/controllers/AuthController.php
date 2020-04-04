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

    public function authAction() {
        $fields = [
            'email' => ['defaultValue' => null, 'required' => true, 'validate' => 'email'],
            'password' => ['defaultValue' => null, 'required' => true],
        ];
        
        $this->parseRequest($fields);
        $email = trim($this->request('email'));
        $password = md5(trim($this->request('password')));
        $this->userData = $this->model->login($email, $password);
        
        header("Location: ".ADMIN_PATH);
    }        

    public function indexAction() {
        try {
            if ($this->isAdmin()) {
                header("Location: ".ADMIN_PATH.'/home');
            } else {
                $this->authAction();
            }
        } catch (Exception $e) {
            $data = [
                'exception' => $e->getMessage()
            ];
            $this->view->genView('authView.php', 'templateView.php', 'Admin Panel', '', '', $data);
        }
    }
}