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
class PedidoController extends FrontController {

    public function fechar()
    {
        $carrinho = Carrinho::getFromSession(false);
        $pessoa = new Pessoa;
        $endereco = new Endereco;
        $this->checkCar($carrinho);
        require $this->getFilePath('fechar-pedido');
    }

    /**
     * Verifica se o carrinho é válido
     * @param type $carrinho
     * @param type $redirect
     */
    public function checkCar($carrinho, $redirect = '/')
    {
        if (!$carrinho->getId()) {
            header('Location: ' . appUrl($redirect));
            die();
        }
    }

    public function execFecharPedido()
    {
        $carrinho = Carrinho::getFromSession(false);
        $this->checkCar($carrinho); // Se não existir redireciona para a home

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
        $pedidoFacade->setPedido($carrinho->getId(), $pessoa, $endereco);

        if ($pedidoFacade->save()) {

            $_SESSION['pedido_cadastrado'] = $pedidoFacade->getPedido()->getData();

            // Retira o carrinho da sessão e gera um novo id de sessão
            unset($_SESSION[Carrinho::SESSION]);
            session_regenerate_id();

            header('Location: ' . appUrl('/pedido/cadastrado'));
            die();
        } elseif (!empty($errors = $pedidoFacade->getErrors())) {

            require $this->getFilePath('fechar-pedido');
        } else {
            echo 'Erro inesperado ao cadastrar pedido!';
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

        $pedido = new Pedido();
        $pedido->setData($dataPedido);

        require $this->getFilePath('pedido-cadastrado');
    }

    public function acompanhar()
    {
        require $this->getFilePath('pedido-acompanhar');
    }

    public function acompanharForm()
    {
        $pedido = (new Pedido())->getById(filter_input(INPUT_POST, 'id_pedido'));
        $senha = filter_input(INPUT_POST, 'senha');
        $cpf = str_replace(['-', '_', '.', ' '], '', filter_input(INPUT_POST, 'cpf'));

        $erros = null;

        if (!$pedido) {
            $erros = 'Pedido não encontrado!';
        } elseif (empty($senha) && empty($cpf)) {
            $erros = 'Informe a senha de acesso ou o CPF do comprador';
        } elseif ($pedido->getSenhaAcesso() != $senha && $pedido->cliente()->getCpf() != $cpf) {
            $erros = 'Senha ou CPF não corresponde ao número do pedido';
        }

        require $this->getFilePath('pedido-acompanhar');
    }
}
