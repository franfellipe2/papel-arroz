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
use app\facades\PedidoFacade;

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
        $endereco = new Endereco();

        $pessoa->setNome($nome);
        $pessoa->setSenha(time());
        $pessoa->setCpf($cpf);
        $pessoa->setEmail($email);
        $pessoa->setWhatssap($whatssap);

        $endereco->setLongradouro($longradouro);
        $endereco->setNumero($numero);
        $endereco->setComplemento($complemento);
        $endereco->setBairro($bairro);



        $pedidoFacade = new PedidoFacade();
        $pedidoFacade->setPedido($_SESSION[Carrinho::SESSION]['id'], $pessoa, $endereco);

        if ($pedidoFacade->save()) {

            $_SESSION['pedido_cadastrado'] = $pedidoFacade->getPedido()->getData();
            header('Location: ' . appUrl('/pedido/cadastrado'));
            die();
        }
    }

    /**
     * Pagina de sucesso de pedido cadastrado
     */
    public function pedidoCadastrado()
    {
        if (!isset($_SESSION['pedido_cadastrado'])) {
            header('Location: ' . appUrl('/'));
            die();
        }
        
        $dataPedido = $_SESSION['pedido_cadastrado'];
        unset($_SESSION['pedido_cadastrado']);
        
        $pedido = new Pedido();        
        $pedido->setData($dataPedido);


        require $this->getFilePath('pedido-cadastrado');
    }
}
