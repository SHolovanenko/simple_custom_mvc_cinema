<?php

class Router {

    static function start($linkDb) {
        
        $controllerName = '';
        $actionName = 'index';
        $routes = explode('/', $_SERVER['REQUEST_URI']);

        if (!empty($routes[1])) {	
            $controllerName = $routes[1];
        }

        if ($controllerName == '' || $controllerName == 'index.php' || $controllerName == 'index.html') {
            $controllerName = 'Home';
        }

        if (!empty($routes[2])) {
            $actionName = $routes[2];
        }

        if (!empty($routes[3])) {
            $arg = $routes[3];
        }

        $modelName = $controllerName.'Model';
        $controllerName = $controllerName.'Controller';
        $actionName = $actionName.'Action';
        $modelFile = $modelName.'.php';
        $modelPath = "app/models/".$modelFile;

        if (file_exists($modelPath)) {
            include "app/models/".$modelFile;
        }

        $controllerFile = $controllerName.'.php';
        $controllerPath = "app/controllers/".$controllerFile;
        
        if(file_exists($controllerPath)) {
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
    
    private static function ErrorPage404() {
        $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
        header('HTTP/1.1 404 Not Found');
        header("Status: 404 Not Found");
        //header('Location:'.$host.'404');
    }
}