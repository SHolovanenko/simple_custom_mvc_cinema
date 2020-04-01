<?php

namespace App\Models;

use App\Core\Model;

class MovieModel extends Model {
    const ITEMS_PER_PAGE = 10;

    private $linkDb;

    public function __construct($linkDb) {
    	$this->linkDb = $linkDb;
    }
    
    public function getData() {
        return [];
    }

    public function getById($id) {
        $result = null;

        $id = htmlspecialchars($id);
        $sql = "SELECT *".
                "FROM movies ".
                "WHERE id = '". $this->linkDb->real_escape_string($id) ."' AND deleted_at IS NULL";

        $movie = $this->linkDb->query($sql);

        if ($movie->num_rows == 1)
            $result = $movie->fetch_assoc();
        
        return $result;
    }

    public function getByAlias($alias) {
        $result = null;

        $alias = htmlspecialchars($alias);
        $sql = "SELECT *".
                "FROM movies ".
                "WHERE alias = '". $this->linkDb->real_escape_string($alias) ."' AND deleted_at IS NULL";

        $movie = $this->linkDb->query($sql);

        if ($movie->num_rows == 1)
            $result = $movie->fetch_assoc();
        
        return $result;
    }

    public function getMovieSessionsById($id) {
        $result = null;
        $sql = "SELECT movie_sessions.id, start, end, rooms.name AS room FROM movie_sessions ".
                "JOIN rooms ON rooms.id = movie_sessions.room_id ".
                "WHERE deleted_at IS NULL AND start > NOW() AND movie_sessions.movie_id = ".$this->linkDb->real_escape_string($id)." ".
                "ORDER BY start";

        $movieSessions = $this->linkDb->query($sql);

        if ($movieSessions->num_rows > 0)
            $result = $this->resultToArray($movieSessions);

        return $result;
    }
    
    public function getList($page) {
        $result = [];

        $offset = intval($page) * self::ITEMS_PER_PAGE - self::ITEMS_PER_PAGE;
        $sql = "SELECT id, title, alias, description_short, poster, created_at FROM movies 
                WHERE deleted_at IS NULL ORDER BY created_at DESC LIMIT ". self::ITEMS_PER_PAGE ." OFFSET ". $offset;
        $movies = $this->linkDb->query($sql);

        if ($movies->num_rows > 0) {
            $rows = $this->resultToArray($movies);
            $result['movies'] = $rows;
            $result['totalMovies'] = $this->getTotalMovies();
            $result['totalPages'] = $this->getTotalPages();
        }

        return $result;
    } 
    
    public function getTotalMovies() {
        $result = 0;

        $sql = "SELECT count(id) as 'totalMovies' FROM movies WHERE deleted_at IS NULL";
        $totalMovies = $this->linkDb->query($sql);

        if ($totalMovies->num_rows == 1) {
            $row = $totalMovies->fetch_assoc(); 
            $result = $row['totalMovies'];
        }

        return $result;
    } 

    public function getTotalPages() {
        return ceil($this->getTotalMovies() / self::ITEMS_PER_PAGE);
    }

    public function getTopPopular($top) {
        $result = [];

        $sql = "SELECT movies.id, movies.title, movies.alias, movies.description_short, movies.poster, count(*) as visits FROM movies 
                JOIN movie_sessions ON movie_sessions.movie_id = movies.id
                JOIN session_registrations ON session_registrations.movie_session_id = movie_sessions.id
                GROUP BY movies.id LIMIT ". $top;

        $movies = $this->linkDb->query($sql);
        if ($movies->num_rows > 0) {
            $rows = $this->resultToArray($movies);
            $result['movies'] = $rows;
        }

        return $result;
    }
}
