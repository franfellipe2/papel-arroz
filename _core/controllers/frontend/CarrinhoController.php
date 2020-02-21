<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

use app\models\Carrinho;
use app\models\Produto;
use app\facades\CarrinhoFacade;

/**
 * Description of CategoriaController
 *
 * @author franf
 */
class CarrinhoController extends frontController {

    private $carrinho;

    public function __construct($request, $response)
    {

        $this->carrinho = new Carrinho();
        parent::__construct($request, $response);
    }

    /**
     * Adicionar Produto ao carrinho
     * @param type $produtoId
     */
    public function addProduto($produtoId)
    {
        // Tenta pegar o carrinho da sessão, se não tiver cria um
        $this->carrinho = Carrinho::getFromSession();

        $qtd = filter_input(INPUT_POST, 'quantidade', FILTER_VALIDATE_INT);
        $increment = filter_input(INPUT_POST, 'increment', FILTER_VALIDATE_BOOLEAN);
       
        $carrinhoFacade = new CarrinhoFacade();
        $carrinhoFacade->addProduto($produtoId, $this->carrinho, $increment, $qtd);
        
        unset($_SESSION[Carrinho::SESSION]);
        
        header('Location: ' . appUrl('/carrinho'));
        die();
    }

    /**
     * Diminuir Produto ao carrinho
     * @param type $produtoId
     */
    public function minusProduto($produtoId)
    {
        $this->carrinho->setData($this->carrinho->getSession());
        $this->carrinho->minusProduto(filter_var($produtoId, FILTER_VALIDATE_INT));
        
        unset($_SESSION[Carrinho::SESSION]);
        
        header('Location: ' . appUrl('/carrinho'));
        
        die();
    }

    /**
     * Diminuir Produto ao carrinho
     * @param type $produtoId
     */
    public function removeProduto($produtoId)
    {
        $this->carrinho->setData($this->carrinho->getSession());
        $this->carrinho->removeProduto(filter_var($produtoId, FILTER_VALIDATE_INT));
       
        unset($_SESSION[Carrinho::SESSION]);
        
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
        
        // Tenta pegar os dados da sessão
        if (($data = $carrinho->getSession())) {
            $carrinho->setData($data);
            
            // Verifica se tem um carrinho cadastrado pelo id de sessão
        } elseif (( $car = (new Carrinho())->getByIdSession(session_id()))) {
            $carrinho = $car;
        }
        require $this->getFilePath('carrinho');
    }
}
