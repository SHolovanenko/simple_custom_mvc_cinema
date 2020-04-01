<?php
require_once 'app'.DS.'core'.DS.'Model.php';
require_once 'app'.DS.'core'.DS.'View.php';
require_once 'app'.DS.'core'.DS.'Controller.php';
require_once 'app'.DS.'core'.DS.'Router.php';

$linkDb = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

mysqli_set_charset($linkDb,'utf8');

Administrator\App\Core\Router::start($linkDb, ADMIN_PATH);