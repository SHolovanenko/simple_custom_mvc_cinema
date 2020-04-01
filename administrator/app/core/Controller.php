<?php

namespace App\Administartor\Core;

use Exception;

class Controller {

    private $requestParams;
    
    public function indexAction() {
        //
    }

    public function parseRequest($fields) {
        $method = $_SERVER['REQUEST_METHOD'];

        foreach ($fields as $name => $options) {
            $this->requestParams[$name] = $options['defaultValue'];

            switch ($method) {
                case 'PUT':
                case 'POST':
                    if (array_key_exists($name, $_POST) && !empty($_POST[$name]))
                        $this->requestParams[$name] = htmlspecialchars($_POST[$name]);

                    break;
                case 'GET':
                    if (array_key_exists($name, $_GET) && !empty($_GET[$name]))
                        $this->requestParams[$name] = htmlspecialchars($_GET[$name]);

                    break;
                default:
                    //
                    break;
            }

            if ($options['required'])
                if (empty($this->requestParams[$name]))
                    throw new Exception($name ." is required");
        }
    }

    public function request($name, $defaultValue = null) {
        if (isset($this->requestParams[$name]))
            return $this->requestParams[$name];

        return $defaultValue;
    }

    public function getAllRequestParams() {
        return $this->requestParams;
    }

    public function isAdmin() {
        if (isset($_SESSION['roleId']))
            if ($_SESSION['roleId'] == 1)
                return true;

        return false;
    }
    
}
