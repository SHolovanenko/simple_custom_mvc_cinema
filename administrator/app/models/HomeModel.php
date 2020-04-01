<?php

namespace App\Administartor\Models;

use App\Administartor\Core\Model;

class HomeModel extends Model{
    private $linkDb;
    
    public function __construct($linkDb) {
        $this->linkDb = $linkDb;
    }
    
    public function getData() {
        return [];
    }
    
}