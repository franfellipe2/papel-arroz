<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

use app\models\Produto;

/**
 * Description of CategoriaController
 *
 * @author franf
 */
class ProdutoController extends frontController {

    private $produto;

    public function __construct($request, $response)
    {
        $this->produto = new Produto;
        parent::__construct($request, $response);
    }

    public function show($slug)
    {

        if (($produto = $this->produto->getBySlug($slug))) {            
            require $this->getFilePath('produto');
        } else {                     
            $this->getPage404();
        }
    }
}
