<?php

session_start();
require '../vendor/autoload.php';
require '../_core/functions.php';

if (!empty($_GET['action']) && !empty($_GET['pg'])) {
    $classController = 'app\\controllers\\admin\\' . $_GET['pg'] . 'Controller';
    $controller = new $classController;
    $controller->{$_GET['action']}();
} else {
    require 'home.php';
}

