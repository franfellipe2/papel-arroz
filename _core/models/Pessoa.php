<?php

namespace app\models;

use app\models\Model;
use app\interfaces\ModelInterface;
use app\DB;
use app\validates\PessoaValidate;

/**
 * Description of Categoria
 *
 * @author franf
 */
class Pessoa extends Model implements ModelInterface {

    protected $data = [
        'id'       => null,
        'nome'     => null,
        'senha'    => null,
        'cpf'      => null,
        'email'    => null,
        'whatssap' => null
    ];
    protected $table = 'pessoas';

    public function getByCpf($cpf)
    {
        $db = new DB();
        $r = $db->select('SELECT * FROM ' . $this->getTable() . ' WHERE cpf = :cpf', array(':cpf' => $cpf));
        if (!empty($r)) {
            $this->setData($r[0]);
            return $this;
        } else {
            return false;
        }
    }

    public function save($excludeFields = array())
    {
        $valid = new PessoaValidate($this);
        $valid->nome();
        $valid->email();
        $valid->cpf();
        $valid->whatssap();
        parent::save($excludeFields);
    }

    public function getWhatssap()
    {
        return $this->data['whatssap'];
    }

    public function setWhatssap($whatssap)
    {
        return $this->data['whatssap'] = $whatssap;
    }

    public function getEmail()
    {
        return $this->data['email'];
    }

    public function setEmail($email)
    {
        return $this->data['email'] = $email;
    }

    public function getCpf()
    {
        return $this->data['cpf'];
    }

    public function setCpf($cpf)
    {
        $this->data['cpf'] = $cpf;
    }

    public function getId()
    {
        return $this->data['id'];
    }

    public function setId($id)
    {
        return $this->data['id'] = $id;
    }

    public function getNome()
    {
        return $this->data['nome'];
    }

    public function setNome($nome)
    {
        return $this->data['nome'] = $nome;
    }

    public function getNumero()
    {
        return $this->data['numero'];
    }

    public function setNumero($Numero)
    {
        return $this->data['numero'] = $Numero;
    }

    public function getSenha()
    {
        return $this->data['senha'];
    }

    public function setSenha($Senha)
    {
        return $this->data['senha'] = $Senha;
    }
}
