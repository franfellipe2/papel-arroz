<?php

session_start();
require '../vendor/autoload.php';
require '../_core/functions.php';

use \app\models\Login;

// Verifica Login
if (!Login::checkLogin()) {
    header('Location: ' . appUrl('/admin/login.php'));
    die();
}

// Rotas por $_GET
if (!empty($_GET['action']) && !empty($_GET['pg'])) {
    $class = ucfirst($_GET['pg']);
    $classController = 'app\\controllers\\admin\\' . $class . 'Controller';
    $controller = new $classController;
    $controller->{$_GET['action']}();
} else {
    require 'home.php';
}

