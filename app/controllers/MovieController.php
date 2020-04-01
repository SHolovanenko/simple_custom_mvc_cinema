<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\MovieModel;
use Exception;

class MovieController extends Controller {
    
    const TOP_POPULAR = 5;

    private $model;
    private $view;
            
    function __construct($linkDb) {
        $this->model = new MovieModel($linkDb);
        $this->view = new View();
    }

    public function getAction($idOrAlias, $useAlias = USE_ALIAS) {
        try {
            if ($useAlias) {
                $movie = $this->model->getByAlias($idOrAlias);
            } else {
                $movie = $this->model->getById($idOrAlias);
            }

            $movieSessions = $this->model->getMovieSessionsById($movie['id']);

            $result = [
                'movie' => $movie,
                'movieSessions' => $movieSessions
            ];

            $this->view->json($result);
        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }

    public function allAction($page = 1) {
        try {
            $listMovies = $this->model->getList($page);
            $this->view->json($listMovies);
        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }
    
    public function popularAction() {
        try {
            $listMovies = $this->model->getTopPopular(self::TOP_POPULAR);
            $this->view->json($listMovies);
        } catch (Exception $e) {
            $this->view->json(['exception' => $e->getMessage()]);
        }
    }

    function indexAction() {
        $data = [];
        $this->view->json($data);
    }
}