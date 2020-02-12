<?php

namespace app\models;

use app\models\Model;
use app\interfaces\ModelInterface;
use app\DB;
use app\models\Produto;

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
        'contatos' => null        
    ];
    private $table = 'compradores';

    public function save($excludeFields = array())
    {
        parent::save($excludeFields);
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
        return $this->data['Numero'];
    }

    public function setNumero($Numero)
    {
        return $this->data['Numero'] = $Numero;
    }
   
    public function getSenha()
    {
        return $this->data['Senha'];
    }

    public function setSenha($Senha)
    {
        return $this->data['Senha'] = $Senha;
    }
    
    public function getContatos()
    {
        return $this->data['Contatos'];
    }

    public function setContatos($Contatos)
    {
        return $this->data['Contatos'] = $Contatos;
    }
  
}
