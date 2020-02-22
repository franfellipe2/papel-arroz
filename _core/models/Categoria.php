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
class Categoria extends Model implements ModelInterface {

    protected $data = [
        'id'        => '',
        'nome'      => '',
        'descricao' => '',
        'cat_pai'   => '',
    ];
    private $table = 'categorias';
    private $produtosTable = 'produtos';
    private $produtos = array();

    public function save($excludeFields = array())
    {
        $this->validNome();
        $this->validDescricao();
        $this->validPai();
        $this->setSlug($this->getNome());
        parent::save($excludeFields);
    }

    public function validNome()
    {

        if (!$this->getNome()) {
            $this->addError('nome', 'Nome em branco!');
            return false;
        } elseif (!empty($c = $this->getByName($this->getNome())) && $c['id'] != $this->getId()) {
            $this->addError('nome', 'Este nome de categoria já existe!');
            return false;
        } elseif (strlen($this->getNome()) < 2) {
            $this->addError('nome', 'O nome deve ter pelomenos 2 caracteres!');
            return false;
        }
        return true;
    }

    /**
     * Retornas todos os produtos
     */
    public function getProdutos($limit = array(), $orderBy = array())
    {
        $db = new DB();
        
        $params[':cat_id'] = $this->getId();
        $args = '';
        
        if (!empty($orderBy) && in_array($orderBy[1], ['asc', 'desc']) && in_array($orderBy[0], array_keys($this->data))) {
            $args .= ' ORDER BY ' . $orderBy[0] . ' ' . $orderBy[1];
        }       
        if (!empty($limit)) {
            $args .= ' LIMIT :start, :offset';
            $params[':start'] = $limit[0];
            $params[':offset'] = $limit[1];
        }
        
        $sql = 'SELECT produtos.* FROM `produtos` 
                INNER JOIN prod_cat
                ON prod_cat.prod_id = `produtos`.`id`
                AND prod_cat.cat_id = :cat_id ' . $args;



        $r = $db->select($sql, $params);
        foreach ($r as $p => $data) {
            $p = new Produto();
            $p->setData($data);
            $this->produtos[] = $p;
        }

        return $this->produtos;
    }

    public function validDescricao()
    {

        if (strlen($this->getDescricao()) > 255) {
            $this->addError('descricao', 'A descrição deve ter no máximo 255 caracteres!');
            return false;
        }
        return true;
    }

    public function validPai()
    {
        return true;
    }

    public function getByName($name)
    {
        $sql = new DB();
        $r = $sql->select('SELECT * FROM `' . $this->getTable() . '` WHERE `' . $this->getTable() . '`.`nome` = \'' . $name . '\'');
        if (empty($r)) {
            return $r;
        }
        return $r[0];
    }

    public function getById($id)
    {
        $sql = new DB();
        $r = $sql->select('SELECT * FROM `' . $this->getTable() . '` WHERE `' . $this->getTable() . '`.`id` = \'' . $id . '\'');
        if (empty($r)) {
            return $r;
        }
        return $r[0];
    }

    function getId()
    {
        return $this->data['id'];
    }

    function getNome()
    {
        return $this->data['nome'];
    }

    function getDescricao()
    {
        return $this->data['descricao'];
    }

    function getPai()
    {
        return $this->data['cat_pai'];
    }

    function setId($id)
    {
        $this->data['id'] = $id;
    }

    function setNome($nome)
    {
        $this->data['nome'] = $nome;
    }

    function setDescricao($descricao)
    {
        $this->data['descricao'] = $descricao;
    }

    function setPai($pai)
    {
        $this->data['cat_pai'] = (!empty($pai) ? $pai : null);
    }

    public function getData(): array
    {
        return $this->data;
    }

    public function getTable(): string
    {
        return $this->table;
    }
}
