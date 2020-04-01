<?php
namespace App\Models;

use App\Core\Model;
use Exception;

class SessionRegistrationModel extends Model {

    private $linkDb;
    
    public function __construct($linkDb) {
        $this->linkDb = $linkDb;
    }
    
    public function getData() {
        return [];
    }

    public function isPlaceAvailable($movieSessionId, $row, $column) {
        $sql = "SELECT id FROM session_registrations WHERE ".
                "movie_session_id = ". $this->linkDb->real_escape_string($movieSessionId) .' AND '.
                "place_row = ". $this->linkDb->real_escape_string($row) .' AND '.
                "place_column = ". $this->linkDb->real_escape_string($column);
        
        $result = $this->linkDb->query($sql);

        if ($result->num_rows == 0)
            return true;

        return false;
    }

    public function add($params) {
        if (!$this->isPlaceAvailable($params['movieSessionId'], $params['placeRow'], $params['placeColumn']))
            throw new Exception('Place is not available');

        $sql = "INSERT INTO session_registrations (email, phone, movie_session_id, place_row, place_column) VALUES ('".
                $this->linkDb->real_escape_string($params['email'])."','".
                $this->linkDb->real_escape_string($params['phone'])."','".
                $this->linkDb->real_escape_string($params['movieSessionId'])."','".
                $this->linkDb->real_escape_string($params['placeRow'])."','".
                $this->linkDb->real_escape_string($params['placeColumn'])."')";
        
        $result = $this->linkDb->query($sql);

        if ($result)
            $result = $this->linkDb->insert_id;

        return $result;
    }
    
}