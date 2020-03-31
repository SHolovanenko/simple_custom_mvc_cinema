<?php
session_start();
require_once 'config.php';
header('Content-Type: text/html; charset=utf-8');
ini_set('display_errors', 1);
require_once 'app'.DS.'init.php';