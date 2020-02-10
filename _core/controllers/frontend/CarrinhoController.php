<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

use app\models\Categoria;

/**
 * Description of CategoriaController
 *
 * @author franf
 */
class CarrinhoController extends frontController {

    private $categoria;

    public function __construct()
    {
        $this->categoria = new Categoria;
    }

    /**
     * Adicionar Produto ao carrinho
     * @param type $produtoId
     */
    public function addProduto($produtoId)
    {
        header('Location: '. appUrl('/carrinho'));
        die();
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
