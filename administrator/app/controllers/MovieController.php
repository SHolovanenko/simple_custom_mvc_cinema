<?php

class MovieController extends Controller {
    
    private $model;
    private $view;
            
    function __construct($linkDb) {
        $this->model = new MovieModel($linkDb);
        $this->view = new View();
    }

    public function getAction($id) {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $movie = $this->model->getById($id);
            $this->view->json($movie);
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
                'title' => ['defaultValue' => null, 'required' => true],
                'alias' => ['defaultValue' => null, 'required' => false],
                'descriptionShort' => ['defaultValue' => null, 'required' => false],
                'descriptionFull' => ['defaultValue' => null, 'required' => true],
                'poster' => ['defaultValue' => null, 'required' => false],
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
                'title' => ['defaultValue' => null, 'required' => false],
                'alias' => ['defaultValue' => null, 'required' => false],
                'descriptionShort' => ['defaultValue' => null, 'required' => false],
                'descriptionFull' => ['defaultValue' => null, 'required' => false],
                'poster' => ['defaultValue' => null, 'required' => false],
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