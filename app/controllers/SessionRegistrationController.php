<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\SessionRegistrationModel;
use Exception;

class SessionRegistrationController extends Controller {
    
    private $view;
    private $model;
            
    public function __construct($linkDb) {
        $this->model = new SessionRegistrationModel($linkDb);
        $this->view = new View();
    }

    public function addAction() {
        try {
            $keywords = 'cinema, movie';
            $description = 'Cinema registration page';

            $fields = [
                'email' => ['defaultValue' => null, 'required' => true],
                'phone' => ['defaultValue' => null, 'required' => true],
                'movieSessionId' => ['defaultValue' => null, 'required' => true],
                'place' => ['defaultValue' => null, 'required' => true],
            ];
            
            $this->parseRequest($fields);
            $params = $this->getAllRequestParams();
            $data['movieSessionId'] = $params['movieSessionId'];
            $place = explode('_', $params['place']);
            $params['placeRow'] = $place[0];
            $params['placeColumn'] = $place[1];
            $resultId = $this->model->add($params);

            $data['success'] = $resultId ? true : false;
            $data['resultId'] = $resultId;

            $this->view->genView('movieSessionRegistrationView.php', 'templateView.php', 'Registration', $keywords, $description, $data);
        
        } catch (Exception $e) {
            $data = [
                'success' => false,
                'exception' => $e->getMessage(),
                'movieSessionId' => $this->request('movieSessionId')
            ];

            $this->view->genView('movieSessionRegistrationView.php', 'templateView.php', 'Registration', $keywords, $description, $data);
        }
     }
            
    public function indexAction() {
        $data = ['data' => 'This is Home'];
        $this->view->json($data);
    }
}