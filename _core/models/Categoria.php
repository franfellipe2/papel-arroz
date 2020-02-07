<?php
namespace Models;

require_once '../_core/model/Model.php';
require_once '../_core/interfaces/ModelInterface.php';
require_once '../_core/DB.php';



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

    public function save($excludeFields = array())
    {
        $this->validNome();
        $this->validDescricao();
        $this->validPai();

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