<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

use app\models\Carrinho;
use app\models\Pedido;
use app\models\Pessoa;
use app\models\Endereco;
use app\DB;

/**
 * Description of PedidoController
 *
 * @author franf
 */
class PedidoController extends frontController {

    public function fechar()
    {
        $carrinho = Carrinho::getFromSession(false);
        if (!$carrinho->getId()) {
            header('Location: ' . appUrl('/'));
            die();
        }

        require $this->getFilePath('fechar-pedido');
    }

    public function checkoutPedido()
    {
        
    }

    public function execFecharPedido()
    {
        $nome = filter_input(INPUT_POST, 'nome');
        $cpf = filter_input(INPUT_POST, 'cpf');
        $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $whatssap = filter_input(INPUT_POST, 'whatssap', FILTER_VALIDATE_INT);
        $longradouro = filter_input(INPUT_POST, 'longradouro');
        $numero = filter_input(INPUT_POST, 'numero', FILTER_VALIDATE_INT);
        $complemento = filter_input(INPUT_POST, 'complemento');
        $bairro = filter_input(INPUT_POST, 'bairro');

        $pessoa = new Pessoa();
        $endero = new Endereco();
        $pedido = new Pedido();

        if (($p = $pessoa->getByCpf($cpf))) {
            $pessoa = $p;
        }
        $pessoa->setNome($nome);
        $pessoa->setSenha(time());
        $pessoa->setCpf($cpf);
        $pessoa->setEmail($email);
        $pessoa->setWhatssap($whatssap);

        $endero->setLongradouro($longradouro);
        $endero->setNumero($numero);
        $endero->setComplemento($complemento);
        $endero->setBairro($bairro);
        
      

        $db = new DB();
        $db->getPDO()->beginTransaction();

        try {
            
        } catch (\PDOException $ex) {
            
        }


        var_dump($pedido);
    }
}
