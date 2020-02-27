<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

use app\models\Produto;
use app\utils\Paginacao;

/**
 * Description of CategoriaController
 *
 * @author franf
 */
class ProdutoController extends FrontController {

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

    public function pesquisa()
    {
        $pagination = new Paginacao(new Produto, 3, 8);
        $pesquisa = filter_input(INPUT_GET, 'pesquisa');
        $produtos = $this->produto->getSearch($pesquisa, $pagination->limit());

        require $this->getFilePath('pesquisa');
    }
}
