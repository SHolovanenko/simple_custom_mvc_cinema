<?php

namespace Administrator\App\Controllers;

use Administrator\App\Core\Controller;
use Administrator\App\Core\View;
use Administrator\App\Models\MovieSessionModel;
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
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $movieSession = $this->model->getById($id);
            $this->view->json($movieSession);
        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }

    public function allAction($page = 1) {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $listMovies = $this->model->getList($page);
            $this->view->json($listMovies);
        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }

    public function addAction() {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $fields = [
                'movieId' => ['defaultValue' => null, 'required' => true],
                'roomId' => ['defaultValue' => null, 'required' => true],
                'start' => ['defaultValue' => null, 'required' => true]
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

    public function deleteAction($id, $softDelete = DB_USE_SOFTDELETE) {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');
                
            $result = $this->model->delete($id, $softDelete);

            $this->view->json(['success' => $result]);

        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }

    public function editAction($id) {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $fields = [
                'movieId' => ['defaultValue' => null, 'required' => true],
                'roomId' => ['defaultValue' => null, 'required' => true],
                'start' => ['defaultValue' => null, 'required' => true]
            ];
            
            $this->parseRequest($fields);
            $params = $this->getAllRequestParams();
            $resultId = $this->model->edit($id, $params);

            $result['success'] = $resultId ? true : false;
            $result['resultId'] = $resultId;
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