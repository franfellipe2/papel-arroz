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
        $id = (int) $produtoId;
        $qtd = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);       
        $increment = filter_input(INPUT_POST, 'increment', FILTER_VALIDATE_BOOLEAN);
        $pnc = $this->carrinho->getProduto($id, true); // produto no carrinho
        $p = new Produto();
        
        if ($qtd == 0) {            
            $this->carrinho->removeProduto($id);
        } elseif (!$pnc) {            
            $p = (new Produto())->getById($id);
            $this->carrinho->InsertProduto($p, 1);
        } elseif ($pnc) {
            $p->setData($pnc);           
            $this->carrinho->updateProduto($p, ( $increment ? $pnc['quantidade'] + $qtd : $qtd) );
        }
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
        header('Location: ' . appUrl('/carrinho'));
        die();
    }
    
    /**
     * Diminuir Produto ao carrinho
     * @param type $produtoId
     */
    public function removeProduto($produtoId)
    {
        $this->carrinho->removeProduto(filter_var($produtoId, FILTER_VALIDATE_INT));
        header('Location: ' . appUrl('/carrinho'));
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
        $backUrl = $this->getRequest()->getServerParams()['HTTP_REFERER'];       
        require $this->getFilePath('carrinho');
    }
}
