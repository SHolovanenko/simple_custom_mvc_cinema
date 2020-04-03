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

            $data = $this->model->getById($id);
            $this->view->genView('movieSessionEditView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        } catch (Exception $e) {
            $data = $this->getAllRequestParams();
            $data['exception'] = $e->getMessage();
            
            $this->view->genView('movieSessionEditView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        }
    }

    public function showAction($id) {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $data['movieSession'] = $this->model->getById($id);
            $data['registrations'] = $this->model->getRegistrations($id);
            $this->view->genView('movieSessionShowView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        } catch (Exception $e) {
            $data = $this->getAllRequestParams();
            $data['exception'] = $e->getMessage();
            
            $this->view->genView('movieSessionShowView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        }
    }

    public function allAction($page = 1) {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $data = $this->model->getList($page);
            $data['currentPage'] = $page;
            
            $this->view->genView('movieSessionAllView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        } catch (Exception $e) {
            $data = [
                'exception' => $e->getMessage()
            ];
            $this->view->genView('movieSessionAllView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        }
    }

    public function addAction() {
        try {
            if (!$this->isAdmin()) 
                throw new Exception('Action restricted');

            $fields = [
                'movieId' => ['defaultValue' => null, 'required' => true],
                'roomId' => ['defaultValue' => 1, 'required' => true],
                'start' => ['defaultValue' => null, 'required' => true]
            ];
            
            $this->parseRequest($fields);
            $params = $this->getAllRequestParams();
            $resultId = $this->model->add($params);

            $result['success'] = $resultId ? true : false;
            $result['resultId'] = $resultId;
            header("Location: /administrator/moviesession/get/".$resultId);

        } catch (Exception $e) {
            $data = $this->getAllRequestParams();
            $data['exception'] = $e->getMessage();
            
            $this->view->genView('movieSessionAddView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', $data);
        }
    }

    public function formAddAction() {
        $this->view->genView('movieSessionAddView.php', 'templateAdministratorView.php', 'Admin Panel', '', '', []);
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
                'roomId' => ['defaultValue' => 1, 'required' => true],
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