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

    public function addProduto($produtoId)
    {
        require $this->getFilePath('carrinho');
       
    }
}
