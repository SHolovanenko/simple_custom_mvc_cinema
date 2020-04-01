<?php

namespace Administrator\App\Models;

use Administrator\App\Core\Model;

class MovieSessionModel extends Model {
    const ITEMS_PER_PAGE = 10;

    private $linkDb;

    public function __construct($linkDb) {
        $this->linkDb = $linkDb;
    }
              
    public function getData() {
        return [];
    }

    public function getById($id) {
        $result = [];

        $id = htmlspecialchars($id);
        $sql = "SELECT *".
                "FROM movie_sessions ".
                "WHERE id = '". $this->linkDb->real_escape_string($id) ."' AND deleted_at IS NULL";

        $movie = $this->linkDb->query($sql);

        if ($movie->num_rows == 1) {
            $row = $movie->fetch_assoc();
            $result = $row;
        }

        return $result;
    }
    
    public function getList($page) {
        $result = [];

        $offset = intval($page) * self::ITEMS_PER_PAGE - self::ITEMS_PER_PAGE;
        $sql = "SELECT * FROM movie_sessions WHERE deleted_at IS NULL LIMIT ". self::ITEMS_PER_PAGE ." OFFSET ". $offset;
        $movies = $this->linkDb->query($sql);

        if ($movies->num_rows > 0) {
            $rows = $this->resultToArray($movies);
            $result['movieSessions'] = $rows;
            $result['totalMovieSessions'] = $this->getTotalMovieSessions();
            $result['totalPages'] = $this->getTotalPages();
        }

        return $result;
    } 
    
    public function getTotalMovieSessions() {
        $result = 0;

        $sql = "SELECT count(*) as 'totalMovieSessions' FROM movie_sessions WHERE deleted_at IS NULL";
        $totalMovies = $this->linkDb->query($sql);

        if ($totalMovies->num_rows == 1) {
            $row = $totalMovies->fetch_assoc(); 
            $result = $row['totalMovieSessions'];
        }

        return $result;
    } 

    public function getTotalPages() {
        return ceil($this->getTotalMovieSessions() / self::ITEMS_PER_PAGE);
    }

    public function add($params) {
        $movieId = htmlspecialchars($params['movieId']);
        $sql = 'SELECT duration_mins FROM movies WHERE id = '. $this->linkDb->real_escape_string($movieId) .' AND deleted_at IS NULL';
        $movie = $this->linkDb->query($sql);

        if ($movie->num_rows == 1) {
            $row = $movie->fetch_assoc();
            $movie = $row;
        }

        $movieDuration = $movie['duration_mins'] ?? 0;
        
        $movieSessionStart = date('Y-m-d H:i:s', strtotime($params['start']));
        $movieSessionEnd = date('Y-m-d H:i:s', strtotime($movieSessionStart.' +'.$movieDuration.' minutes'));

        $sql = "INSERT INTO movie_sessions (movie_id, room_id, start, end) VALUES ('".
                $this->linkDb->real_escape_string($params['movieId'])."','".
                $this->linkDb->real_escape_string($params['roomId'])."','".
                $this->linkDb->real_escape_string($movieSessionStart)."','".
                $this->linkDb->real_escape_string($movieSessionEnd)."')";
        
        $result = $this->linkDb->query($sql);

        if ($result)
            $result = $this->linkDb->insert_id;

        return $result;
    }

    public function delete($id, $softDelete) {
        $sql = "SELECT deleted_at FROM movies WHERE id = ". $this->linkDb->real_escape_string($id);
        $movie = $this->linkDb->query($sql);

        if ($movie->num_rows == 1) {
            $row = $movie->fetch_assoc();
            if (!is_null($row['deleted_at'])) {
                $softDelete = false;
            }
        }

        if ($softDelete)
            return $this->softDelete($id);

        return $this->hardDelete($id);
    }

    public function softDelete($id) {
        $sql = "UPDATE movie_sessions SET deleted_at = NOW() WHERE id = ". $this->linkDb->real_escape_string($id);
        $result = $this->linkDb->query($sql);

        return $result;
    }

    public function hardDelete($id) {
        $sql = "DELETE FROM movie_sessions WHERE id = ". $this->linkDb->real_escape_string($id);
        $result = $this->linkDb->query($sql);

        return $result;
    }

    public function edit($id, $params) {
        $movieId = htmlspecialchars($params['movieId']);
        $sql = 'SELECT duration_mins FROM movies WHERE id = '. $this->linkDb->real_escape_string($movieId) .' AND deleted_at IS NULL';
        $movie = $this->linkDb->query($sql);

        if ($movie->num_rows == 1) {
            $row = $movie->fetch_assoc();
            $movie = $row;
        }

        $movieDuration = $movie['duration_mins'] ?? 0;
        
        $movieSessionStart = date('Y-m-d H:i:s', strtotime($params['start']));
        $movieSessionEnd = date('Y-m-d H:i:s', strtotime($movieSessionStart.' +'.$movieDuration.' minutes'));

        $sql = "UPDATE movie_sessions SET ".
                "movie_id = '".$this->linkDb->real_escape_string($movieId)."',".
                "room_id = '".$this->linkDb->real_escape_string($params['roomId'])."',".
                "start = '".$this->linkDb->real_escape_string($movieSessionStart)."',".
                "end = '".$this->linkDb->real_escape_string($movieSessionEnd)."'".
                "WHERE id = ". $this->linkDb->real_escape_string($id);
        
        $result = $this->linkDb->query($sql);

        return $result;
    }
}
