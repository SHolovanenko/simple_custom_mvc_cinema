<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\MovieSessionModel;
use Exception;

class MovieSessionController extends Controller {
    
    private $model;
    private $view;
            
    function __construct($linkDb) {
        $this->model = new MovieSessionModel($linkDb);
        $this->view = new View();
    }

    public function getAction($id) {
        try {
            $movieSession = $this->model->getById($id);
            $roomPlaces = $this->model->getRoomPlaces($id);
            
            $result = [
                'movieSession' => $movieSession,
                'room' => $roomPlaces
            ];

            $this->view->json($result);
        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }

    public function roomAction($id) {
        try {
            $room = $this->model->getRoomPlaces($id);

            $result['success'] = $room ? true : false;
            $result['room'] = $room;
            $this->view->json($result);

        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }

    function indexAction() {
        $data = [];
        $this->view->json($data);
    }
}