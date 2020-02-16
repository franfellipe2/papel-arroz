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
class CategoriaController extends frontController {

    private $categoria;

    public function __construct($request, $response)
    {
        $this->categoria = new Categoria;
        parent::__construct($request, $response);
    }

    public function listarProdutos($catSlug)
    {

        $categoria = $this->categoria->getBySlug($catSlug);
        if ($categoria) {
            $produtos = $categoria->getProdutos();           
            require $this->getFilePath('categoria');
        } else {                     
            $this->getPage404();
        }
    }
}
