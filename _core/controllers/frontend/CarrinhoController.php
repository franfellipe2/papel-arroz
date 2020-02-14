<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

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
        $this->carrinho = Carrinho::getFromSession();
        parent::__construct($request, $response);
    }

    /**
     * Adicionar Produto ao carrinho
     * @param type $produtoId
     */
    public function addProduto($produtoId)
    {
        $qtdPost = filter_input(INPUT_POST, 'quatindade_produto', FILTER_VALIDATE_INT);
        $qtd = $qtdPost ? $qtdPost : 1;        
        $produto = (new Produto())->getById(filter_var($produtoId, FILTER_VALIDATE_INT));
        $this->carrinho->addProduto($produto, $qtd);
        header('Location: ' . appUrl('/carrinho'));
        die();
    }

    /**
     * Diminuir Produto ao carrinho
     * @param type $produtoId
     */
    public function minusProduto($produtoId)
    {
        $this->carrinho->minusProduto(filter_var($produtoId, FILTER_VALIDATE_INT));   
        header('Location: '. appUrl('/carrinho'));
        die();
    }

    /**
     * Mostrar Carrinho
     * @param type $produtoId
     */
    public function mostrar()
    {
        //unset($_SESSION[Carrinho::SESSION]);
        $carrinho = $this->carrinho->getFromSession();
        require $this->getFilePath('carrinho');
    }
}
