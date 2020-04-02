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
            $keywords = 'cinema, movie, top movies';
            $description = 'Cinema home page';

            if ($useAlias) {
                $movie = $this->model->getByAlias($idOrAlias);
            } else {
                $movie = $this->model->getById($idOrAlias);
            }

            $movieSessions = $this->model->getMovieSessionsById($movie['id']);

            $data = [
                'movie' => $movie,
                'movieSessions' => $movieSessions
            ];

            $this->view->genView('movieView.php', 'templateView.php', $movie['title'], $keywords, $description, $data);
        } catch (Exception $e) {
            $data = [
                'exception' => $e->getMessage()
            ];
            $this->view->genView('movieView.php', 'templateView.php', $movie['title'], $keywords, $description, $data);
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

    function indexAction($page = 1) {
        try {
            $keywords = 'cinema, movie, top movies';
            $description = 'Cinema home page';

            $data = [
                'topPopular' => $this->model->getTopPopular(self::TOP_POPULAR),
                'listMovies' => $this->model->getList($page),
                'currentPage' => $page
            ];

            $this->view->genView('homeView.php', 'templateView.php', 'Cinema home', $keywords, $description, $data);
        } catch (Exception $e) {
            $data = [
                'exception' => $e->getMessage()
            ];
            $this->view->genView('homeView.php', 'templateView.php', 'Cinema home', $keywords, $description, $data);
        }
        
    }
}