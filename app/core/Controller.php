<?php

namespace App\Core;

use Exception;

class Controller {

    private $requestParams;
    
    public function indexAction() {
        //
    }

    public function parseRequest($fields) {
        $method = $_SERVER['REQUEST_METHOD'];
        $exceptions = [];

        foreach ($fields as $name => $options) {
            $this->requestParams[$name] = $options['defaultValue'];

            switch ($method) {
                case 'PUT':
                case 'POST':
                    if (array_key_exists($name, $_POST) && !empty($_POST[$name])) {
                        $this->requestParams[$name] = htmlspecialchars($_POST[$name]);
                    } else {
                        $data = $this->getRawPost($name);
                        if (!empty($data))
                            $this->requestParams[$name] = $data;
                    }

                    break;
                case 'GET':
                    if (array_key_exists($name, $_GET) && !empty($_GET[$name]))
                        $this->requestParams[$name] = htmlspecialchars($_GET[$name]);

                    break;
                default:
                    //
                    break;
            }

            if ($options['required']) {
                if (empty($this->requestParams[$name]))
                    $exceptions[] = ucfirst($name ." is required");

                if (isset($options['validate'])) {
                    try {
                        $this->validate($this->requestParams[$name], $options['validate']);
                    } catch (Exception $e) {
                        $exceptions[] = $e->getMessage();
                    }
                }
            }
        }

        if (!empty($exceptions)) 
            throw new Exception(implode("<br>", $exceptions));
    }

    private function getRawPost($name) {
        $data = file_get_contents("php://input");
        $data = json_decode($data);
        if (isset($data->$name))
            return $data->$name;

        return null;
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

    public function validate($data, $method) {
        $method = __CLASS__.'::validate'. ucfirst($method);
        if (is_callable($method)) 
            call_user_func_array($method, [$data]);
    }

    public function validateEmail($data) {
        if (!filter_var($data, FILTER_VALIDATE_EMAIL))
            throw new Exception('Invalid email');
    }
    
    public function validatePhone($data) {
        if (strlen($data) > 14)
            throw new Exception('Invalid phone number. Too long.');

        if (strlen($data) < 10)
            throw new Exception('Invalid phone number. Too short.');

        if (!filter_var($data,FILTER_SANITIZE_NUMBER_INT))
            throw new Exception('Invalid phone number');
    }

    public function validateText($data) {
        if (strlen($data) < 2)
            throw new Exception('Invalid text. Too short.');
    }
}
