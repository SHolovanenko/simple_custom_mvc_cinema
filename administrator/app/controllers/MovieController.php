<?php

namespace Administrator\App\Controllers;

use Administrator\App\Core\Controller;
use Administrator\App\Core\View;
use Administrator\App\Models\MovieModel;
use Exception;

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

            $data = $this->model->getById($id);
            $this->view->genView('movieEditView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        } catch (Exception $e) {
            $data = $this->getAllRequestParams();
            $data['exception'] = $e->getMessage();
            
            $this->view->genView('movieEditView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        }
    }

    public function allAction($page = 1) {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $data = $this->model->getList($page);
            $data['currentPage'] = $page;
            
            $this->view->genView('movieAllView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        } catch (Exception $e) {
            $data = [
                'exception' => $e->getMessage()
            ];
            $this->view->genView('movieAllView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
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
                'durationMins' => ['defaultValue' => null, 'required' => true],
            ];
            
            $this->parseRequest($fields);
            $params = $this->getAllRequestParams();
            $resultId = $this->model->add($params);

            $result['success'] = $resultId ? true : false;
            $result['resultId'] = $resultId;
            header("Location: /administrator/movie/get/".$resultId);

        } catch (Exception $e) {
            $data = $this->getAllRequestParams();
            $data['exception'] = $e->getMessage();
            
            $this->view->genView('movieAddView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        }
    }

    public function formAddAction() {
        $this->view->genView('movieAddView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', []);
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
                'durationMins' => ['defaultValue' => null, 'required' => false],
            ];
            
            $this->parseRequest($fields);
            $params = $this->getAllRequestParams();
            $resultId = $this->model->edit($id, $params);

            $result['success'] = $resultId ? true : false;
            $result['resultId'] = $resultId;
            header("Location: /administrator/movie/get/".$resultId);

        } catch (Exception $e) {
            $data = $this->getAllRequestParams();
            $data['exception'] = $e->getMessage();
            
            $this->view->genView('movieEditView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        }
    }

    function indexAction() {
        $data = [];
        $this->view->json($data);
    }
}