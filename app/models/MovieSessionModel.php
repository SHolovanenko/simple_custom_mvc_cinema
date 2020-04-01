<?php

namespace App\Models;

use App\Core\Model;
use Exception;

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
        $result = null;

        $id = htmlspecialchars($id);
        $sql = "SELECT * FROM movie_sessions ".
                "WHERE movie_sessions.id = '". $this->linkDb->real_escape_string($id) ."' AND start > NOW() AND deleted_at IS NULL";

        $movieSessions = $this->linkDb->query($sql);

        if ($movieSessions->num_rows == 1)
            $result = $movieSessions->fetch_assoc();

        return $result;
    }

    public function getRoomPlaces($movieSessionId) {
        $sql = "SELECT rooms.rows, rooms.columns FROM movie_sessions ".
                "JOIN rooms ON rooms.id = movie_sessions.room_id ".
                "WHERE ".
                "movie_sessions.id = ". $this->linkDb->real_escape_string($movieSessionId);
        
        $result = $this->linkDb->query($sql);

        if ($result->num_rows != 1) 
            throw new Exception('Can not get room info');
        
        $record = $result->fetch_assoc();
        $rows = $record['rows'];
        $columns = $record['columns'];
        $room = array_fill(0, $rows, array_fill(0, $columns, true));
        
        
        $sql = "SELECT place_row, place_column FROM session_registrations WHERE ".
                "movie_session_id = ". $this->linkDb->real_escape_string($movieSessionId);

        $result = $this->linkDb->query($sql);

        if (!$result) 
            throw new Exception('Can not get room places info');

        $records = $this->resultToArray($result);
        foreach ($records as $record) {
            $room[$record['place_row']][$record['place_column']] = false;
        }

        return $room;
    }

}
