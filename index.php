<?php

session_start();
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/_core/functions.php';

// Create and configure Slim app
$config = ['settings' => [
        'addContentLengthHeader' => false,
    ],
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$app = new \Slim\App($config);

function controllerFactory($controllerPrifix, $request, $response)
{
    $c = 'app\\controllers\\frontend\\' . $controllerPrifix . 'Controller';
    return new $c($request, $response);
}



// ======================================
// ROTAS
// ======================================

// Pagina incial
$app->get('/', function ($request, $response) {    
    $c = controllerFactory('home', $request, $response);
});

// Mostrar produtos por categoria
$app->get('/categoria/{slug}', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('categoria', $request, $response);
    $c->listarProdutos($slug);
});

// Mostrar produtos(detalhes)
$app->get('/produto/{slug}', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('Produto', $request, $response);
    $c->show($slug);
});

// Pesquisar produtos
$app->get('/pesquisa', function($request, $response, $args) {
    $c = controllerFactory('Produto', $request, $response);
    $c->pesquisa();
});

// ================================
// CARRINHO >>>
// ================================

// Mostrar carrinho
$app->get('/carrinho', function($request, $response, $args) {   
    extract($args);    
    $c = controllerFactory('Carrinho', $request, $response);
    $c->mostrar();
});

$app->post('/carrinho/atualiza-quantidade-produto/{id}', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('carrinho', $request, $response);
    $c->updateQuantidade($id);
});

// Adicinar o produto ao carrinho
$app->post('/carrinho/{id}/add', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('Carrinho', $request, $response);
    $c->addProduto($id);
});

// Diminuir produto do carrinho
$app->get('/carrinho/{id}/minus', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('Carrinho', $request, $response);
    $c->minusProduto($id);
});

// Remover o produto ao carrinho
$app->get('/carrinho/{id}/remove', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('Carrinho', $request, $response);
    $c->removeProduto($id);
});



// ================================
// PEDIDO >>>
// ================================

// Fechar pedido
$app->get('/fechar-pedido/', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('Pedido', $request, $response);
    $c->fechar();
});

// Executar Fechar Pedido
$app->post('/executar-fechar-pedido/', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('Pedido', $request, $response);
    $c->execFecharPedido();
});

// Pedido cadastrado
$app->get('/pedido/cadastrado', function($request, $response, $args) {
    extract($args);
    $c = controllerFactory('Pedido', $request, $response);
    $c->pedidoCadastrado();
});


$app->run();
