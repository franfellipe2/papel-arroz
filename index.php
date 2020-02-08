<?php

session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/_core/functions.php';

$rout = explode('/', isset($_GET['route']) ? $_GET['route'] : '/home');
$page = $rout[1];

function FrontendCreateController($controllerPrifix)
{
    $c = 'app\\controllers\\frontend\\' . $controllerPrifix . 'Controller';
    return new $c;
}
switch ($page) {
    case 'home':
        FrontendCreateController('home');
        break;
    case 'p':
        $c = FrontendCreateController('produto');        
        $c->setProdutoBySlug($rout[2]);
        break;
    case 'categoria':
        $c = FrontendCreateController('categoria');        
        $c->setCategoriaBySlug($rout[2]);
        break;
    default :
        require appConfig('frontDir') . '404.php';
        break;
}
