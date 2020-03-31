<?php
class HomeModel extends Model{
    private $linkDb;
    
    public function __construct($linkDb) {
        $this->linkDb = $linkDb;
    }
    
    public function getData() {
        return [];
    }
    
}