<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\facades;

use app\models\Carrinho;
use app\models\Produto;

/**
 * Description of CarrinhoFacade
 *
 * @author franf
 */
class CarrinhoFacade {

    /**
     * Adicionar Produto ao carrinho
     * @param type $produtoId
     */
    static function addProduto($produtoId, Carrinho $carrinho, $increment, $qtd, $desconto = 0, $juros = 0)
    {
        $data = $carrinho->getProduto($produtoId, true); // Verifica se o produto já existe no carrinho        
        $qtd = ( (bool) $increment ? $data['quantidade'] + $qtd : $qtd);        
        
        if ($qtd == 0) {
            $carrinho->removeProduto($produtoId);
        } elseif (!$data) {
            $p = (new Produto())->getById($produtoId);
            $carrinho->InsertProduto($p, $qtd, $desconto, $juros);
        } elseif ($data) {
            $p = new Produto();
            $p->setData($data);
            $carrinho->updateProduto($p, $qtd, $desconto, $juros);
        }
    }

    /**
     * Diminuir Produto ao carrinho
     * @param type $produtoId
     */
    public function minusProduto($produtoId)
    {
        $carrinho->setData($carrinho->getSession());
        $carrinho->minusProduto(filter_var($produtoId, FILTER_VALIDATE_INT));
        header('Location: ' . appUrl('/carrinho'));
        die();
    }

    /**
     * Diminuir Produto ao carrinho
     * @param type $produtoId
     */
    public function removeProduto($produtoId)
    {
        $carrinho->setData($carrinho->getSession());
        $carrinho->removeProduto(filter_var($produtoId, FILTER_VALIDATE_INT));
        header('Location: ' . appUrl('/carrinho'));
        die();
    }

    /**
     * Mostrar Carrinho
     * @param type $produtoId
     */
    public function mostrar()
    {
        $carrinho = new Carrinho();
        if (($data = $carrinho->getSession())) {
            $carrinho->setData($data);
        } elseif (( $car = (new Carrinho())->getByIdSession(session_id()))) {
            $carrinho = $car;
        }
        require $this->getFilePath('carrinho');
    }
}
