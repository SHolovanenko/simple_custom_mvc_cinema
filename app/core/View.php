<?php

namespace App\Core;

class View {

    public function genView($contentView, $templateView, $title, $keywords, $description, $data = null)
    {   
        include 'app/views/'.$templateView;
    }

    public function json($data) {
        echo json_encode($data);
    }
    
}
