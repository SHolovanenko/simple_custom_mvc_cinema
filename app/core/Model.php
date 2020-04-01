<?php

namespace App\Core;

class Model {

    public function getData() {
        return [];
    }
    
    protected function resultToArray($result){
        $arrayedResult = array();
        while ($data = mysqli_fetch_assoc($result)){
            $arrayedResult[] = $data;
        }
        return $arrayedResult;
    }
}
