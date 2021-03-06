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
    private $CanSavePessoa = true; // Se é ou não necessário salvar ou atualizar a pessoa no banco de dados
    private $CanSaveEndereco = true; // se é ou não necessário salvar ou atualizar o endereço no banco de dados   
    private $errors = array();

    public function __construct()
    {
        $this->carrinho = new Carrinho();
        $this->pedido = new Pedido();
        $this->endereco = new Endereco();
        $this->pessoa = new Pessoa();
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getPedido(): Pedido
    {
        return $this->pedido;
    }

    public function save()
    {

        if (!$this->carrinho->getId()) {
            return false;
        }

        $db = new DB();
        $pdo = $db->getPDO();
        $pdo->beginTransaction();

        try {

            if ($this->CanSavePessoa) {
                $this->pessoa->save();
            }
            if ($this->CanSaveEndereco) {
                $this->endereco->save();
            }
            if ($this->pessoa->errorExistis() || $this->endereco->errorExistis()) {
                $this->errors['pessoa'] = $this->pessoa->getErrors();
                $this->errors['endereco'] = $this->endereco->getErrors();
                return false;
            }
            $this->pedido->setIdpessoa($this->pessoa->getId());
            $this->pedido->setIdEndereco($this->endereco->getId());
            $this->pedido->setRecebido(date('Y-m-d H:s:s', time()));
            $this->pedido->setSenhaAcesso(time());

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

    /**
     * 
     * @param type $idCarrinho
     * @param type $pessoa
     * @param type $endereco
     * @return boolean
     */
    public function setPedido($idCarrinho, $pessoa, $endereco)
    {
        // Carrega o carrinho
        if (!$this->carrinho->getById($idCarrinho)) {
            return false;
        }
        $this->setPessoa($pessoa);
        $this->setEndereco($endereco);

        $this->pedido->setIdCarrinho($idCarrinho);
        $this->pedido->setVltotal($this->carrinho->getPrecoCarrinho());
        return true;
    }

    private function setPessoa(Pessoa $pessoa)
    {
        // Recupera a pessoa e atualiza os dados ou cria uma nova

        $cpf = str_replace(['-', '.', '_', ' '], '', $pessoa->getCpf());
        

        if (($p = $this->pessoa->getByCpf($cpf))) {
            
            if (strtolower($p->getNome()) != strtolower($pessoa->getNome())) {
                $pessoa->addError('cpf', 'Existe um nome diferente cadastrado para este CPF! Para dúvidas entre em contato.');
            }
            
            $pessoa->setId($p->getId());
        }        
        $this->pessoa = $pessoa;
    }

    private function setEndereco(Endereco $endereco)
    {
        $enderecos = $this->endereco->getBy([
            'longradouro' => $endereco->getLongradouro(),
            'numero'      => $endereco->getNumero(),
            'complemento' => $endereco->getComplemento(),
            'bairro'      => $endereco->getBairro(),
            'cidade'      => $endereco->getCidade(),
            'estado'      => $endereco->getEstado(),
            'uf'          => $endereco->getUf(),
            'cep'         => $endereco->getCep(),
        ]);

        /*
          Recupera o endereço no banco de dados ou cria um novo
         */
        if (!empty($enderecos)) {
            $this->endereco = $enderecos[0];
            $this->CanSaveEndereco = false;
        } else {
            $this->endereco = $endereco;
        }
    }
}
