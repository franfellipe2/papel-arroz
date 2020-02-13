<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

use app\utils\MensageFromSession;
use app\models\Carrinho;
use app\models\Produto;

/**
 * Description of CategoriaController
 *
 * @author franf
 */
class CarrinhoController extends frontController {

    private $carrinho;

    public function __construct($request, $response)
    {
        $this->carrinho = new Carrinho;       
        parent::__construct($request, $response);
    }

    /**
     * Adicionar Produto ao carrinho
     * @param type $produtoId
     */
    public function addProduto($produtoId)
    {
        unset($_SESSION[Carrinho::CAR_SESSION]);
        $carrinho = $this->carrinho->get();
        var_dump($carrinho);
        header('Location: ' . appUrl('/carrinho'));
    }

    /**
     * Mostrar Carrinho
     * @param type $produtoId
     */
    public function mostrar()
    {
        require $this->getFilePath('carrinho');
    }
}
