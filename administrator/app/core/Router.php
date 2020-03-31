<?php

class Router {
    
    static function start($linkDb, $adminPath) {

        $controllerName = '';
        $actionName = 'index';
        $uri = $_SERVER['REQUEST_URI'];

        if (substr($_SERVER['REQUEST_URI'], 0, strlen($adminPath)) == $adminPath) {
            $uri = substr_replace($_SERVER['REQUEST_URI'],'',0,strlen($adminPath));
        }

        $routes = explode('/', $uri);

        if (!empty($routes[1])) {	
            $controllerName = $routes[1];
        }

        if ($controllerName == '' || $controllerName == 'index.php' || $controllerName == 'index.html') {
            $controllerName = 'Home';
        }

        if (!isset($_SESSION['isAuth'])) {
            $controllerName = "Auth";
        } else {
            if (!empty($routes[2])) {
                $actionName = $routes[2];
            }
    
            if (!empty($routes[3])) {
                $arg = $routes[3];
            }
        }

        $modelName = $controllerName.'Model';
        $controllerName = $controllerName.'Controller';
        $actionName = $actionName.'Action';
        $modelFile = $modelName.'.php';
        $modelPath = "app/models/".$modelFile;

        if (file_exists($modelPath)) {
            include "app/models/".$modelFile;
        }

        $controllerFile = ucfirst($controllerName).'.php';
        $controllerPath = "app/controllers/".$controllerFile;

        if (file_exists($controllerPath)) {
            include "app/controllers/".$controllerFile;
        } else {
            header("Location: /");
        }

        $controller = new $controllerName($linkDb);
        $action = $actionName;

        if (method_exists($controller, $action)) {
			if (isset($arg)) {
				$controller->$action($arg);
			} else {
				$controller->$action();
			}
        }
    }
}