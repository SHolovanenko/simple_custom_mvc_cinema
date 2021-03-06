<?php

namespace Administrator\App\Models;

use Administrator\App\Core\Model;

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
        $result = [];

        $id = htmlspecialchars($id);
        $sql = "SELECT *".
                "FROM movies ".
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
        $sql = "SELECT * FROM movies WHERE deleted_at IS NULL LIMIT ". self::ITEMS_PER_PAGE ." OFFSET ". $offset;
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

        $sql = "SELECT count(*) as 'totalMovies' FROM movies WHERE deleted_at IS NULL";
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

    public function add($params) {
        if (empty($params['alias']))
            $params['alias'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $params['title'])));

        if (empty($params['descriptionShort'])) 
            $params['descriptionShort'] = substr($params['descriptionFull'], 0, 97) . '...';

        $sql = "INSERT INTO movies (title, alias, description_short, description_full, poster, duration_mins) VALUES ('".
                $params['title']."','".$params['alias']."','".$params['descriptionShort']."','".
                $params['descriptionFull']."','".$params['poster']."','".$params['durationMins']."')";
        
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
        $sql = "UPDATE movies SET deleted_at = NOW() WHERE id = ". $this->linkDb->real_escape_string($id);
        $result = $this->linkDb->query($sql);

        return $result;
    }

    public function hardDelete($id) {
        $sql = "DELETE FROM movies WHERE id = ". $this->linkDb->real_escape_string($id);
        $result = $this->linkDb->query($sql);

        return $result;
    }

    public function edit($id, $params) {
        if (!empty($params['alias']))
            $params['alias'] = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $params['alias'])));

        $paramsToUpdate = [];
        if (!empty($params['title']))
            $paramsToUpdate[] = "title = '".$this->linkDb->real_escape_string($params['title'])."'";
            
        if (!empty($params['alias']))
            $paramsToUpdate[] = "alias = '".$this->linkDb->real_escape_string($params['alias'])."'";

        if (!empty($params['descriptionShort']))
            $paramsToUpdate[] = "description_short = '".$this->linkDb->real_escape_string($params['descriptionShort'])."'";
            
        if (!empty($params['descriptionFull']))
            $paramsToUpdate[] = "description_full = '".$this->linkDb->real_escape_string($params['descriptionFull'])."'";
            
        if (!empty($params['poster']))
            $paramsToUpdate[] = "poster = '".$this->linkDb->real_escape_string($params['poster'])."'";
            
        if (!empty($params['durationMins']))
            $paramsToUpdate[] = "duration_mins = '".$this->linkDb->real_escape_string($params['durationMins'])."'";

        $sql = "UPDATE movies SET ". implode(',', $paramsToUpdate) ." WHERE id = ". $this->linkDb->real_escape_string($id);
        
        $result = $this->linkDb->query($sql);

        return $result;
    }
}
