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
            $fields = [
                'email' => ['defaultValue' => null, 'required' => true],
                'phone' => ['defaultValue' => null, 'required' => true],
                'movieSessionId' => ['defaultValue' => null, 'required' => true],
                'placeRow' => ['defaultValue' => null, 'required' => true],
                'placeColumn' => ['defaultValue' => null, 'required' => true],
            ];
            
            $this->parseRequest($fields);
            $params = $this->getAllRequestParams();
            $resultId = $this->model->add($params);

            $result['success'] = $resultId ? true : false;
            $result['resultId'] = $resultId;
            $this->view->json($result);

        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }

    public function roomAction($movieSessionId) {
        try {
            $room = $this->model->getRoomPlaces($movieSessionId);

            $result['success'] = $room ? true : false;
            $result['room'] = $room;
            $this->view->json($result);

        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }
            
    public function indexAction() {
        $data = ['data' => 'This is Home'];
        $this->view->json($data);
    }
}