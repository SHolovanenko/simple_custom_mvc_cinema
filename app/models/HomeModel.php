<?php
namespace App\Models;

use App\Core\Model;

class MainModel extends Model {

    private $linkDb;
    
    public function __construct($linkDb) {
        $this->linkDb = $linkDb;
    }
    
    public function getData() {
        return [];
    }
    
}