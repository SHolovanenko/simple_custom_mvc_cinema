<?php

namespace Administrator\App\Core;

class Model {

    public function getData() {
        //
    }

    protected function resultToArray($result){
        $arrayedResult = array();
        while ($data = mysqli_fetch_assoc($result)){
            $arrayedResult[] = $data;
        }
        return $arrayedResult;
    }

}
