<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

use app\models\Categoria;
use app\utils\Paginacao;
use app\models\Produto;

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

            $currentPage = ($pg = filter_input(INPUT_GET, 'paginate')) ? $pg : 1;
            
            $paginate = new Paginacao(new Produto(), 9, 8, (int) $currentPage);

            $produtos = $categoria->getProdutos($paginate->limit(), ['id', 'desc']);

            require $this->getFilePath('categoria');
        } else {
            $this->getPage404();
        }
    }
}
