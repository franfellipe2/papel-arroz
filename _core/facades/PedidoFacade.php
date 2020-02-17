<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\facades;

use app\models\Pessoa;
use app\models\Pedido;
use app\models\Endereco;
use app\models\Carrinho;
use app\DB;

/**
 * Description of PedidoFacade
 *
 * @author franf
 */
class PedidoFacade {

    private $pedido;
    private $pessoa;
    private $endereco;
    private $carrinho;

    public function __construct()
    {
        $this->carrinho = new Carrinho();
        $this->pedido = new Pedido();
    }

    public function save(Pessoa $pessoa, Endereco $endereco, $idCarrinho)
    {
        $this->pessoa = $pessoa;
        $this->endereco = $endereco;

        // Carrega o carrinho
        if (!$this->carrinho->getById($idCarrinho)) {
            return false;
        }

        $db = new DB();
        $pdo = $db->getPDO();
        $pdo->beginTransaction();

        try {

            // Recupera o ID da pessoa ou cria uma nova
            if ($pessoa->getByCpf()) {
                $this->pessoa->setId($pessoa->getId());
            } else {
                $this->pessoa->save();
            }

            $this->endereco->save();

            $this->pedido->setIdCarrinho($idCarrinho);
            $this->pedido->setIdpessoa($this->pessoa->getId());
            $this->pedido->setIdEndereco($this->endereco->getId());
            $this->pedido->setVltotal($this->carrinho->getPrecoCarrinho());
            $this->pedido->save();

            //
        } catch (\PDOException $ex) {
            echo '<p>' . $ex->getMessage() . '</p>';
            echo '<p><i>' . $ex->getFile() . ' - LINHA [ ' . $ex->getLine() . ' ]</i></p>';
            $pdo->rollBack();
        }

        $pdo->commit();

        return $this;
    }
}
