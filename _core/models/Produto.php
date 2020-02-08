<?php

namespace app\models;

use app\models\Model;
use app\interfaces\ModelInterface;
use app\DB;

/**
 * Description of Categoria
 *
 * @author franf
 */
class Produto extends Model implements ModelInterface {

    protected $data = [
        'id'            => '',
        'titulo'        => '',
        'descricao'     => '',
        'preco'         => '',
        'imagem'        => '',
        'cat_id'        => '',
        'personalizado' => 0,
        'tipo'          => '',
        'filho_id'      => null
    ];
    private $table = 'produtos';

    public function save($excludeFields = array())
    {
        $this->validTitulo();
        $this->validDescricao();
        $this->validPreco();
        $this->validImagem();
        $this->validCategoria();
        $this->validPersonalizado();
        $this->setSlug($this->getTitulo());

        return parent::save($excludeFields);
    }

    public function validTitulo()
    {

        if (!$this->getTitulo()) {
            $this->addError('titulo', 'Titulo em branco!');
            return false;
        } elseif (!empty($c = $this->getByTitulo($this->getTitulo())) && $c['id'] != $this->getId()) {
            $this->addError('titulo', 'Este titulo já existe!');
            return false;
        } elseif (strlen($this->getTitulo()) < 2) {
            $this->addError('titulo', 'O titulo deve ter pelomenos 2 caracteres!');
            return false;
        }
        return true;
    }

    public function validDescricao()
    {

        if (!$this->getDescricao()) {
            $this->addError('descricao', 'A descrição não pode ficar em branco!');
            return false;
        }
        return true;
    }

    public function validPreco()
    {
        if (empty($this->getPreco())) {
            $this->addError('preco', 'Preço em branco!');
            return false;
        }
        return true;
    }

    public function validPersonalizado()
    {
        return true;
    }

    public function validCategoria()
    {
        if (empty($this->getCategoria())) {
            $this->addError('cat_id', 'Categoria não definida!');
            return false;
        }
        return true;
    }

    public function validImagem()
    {
        if (empty($this->getImagem())) {
            $this->addError('imagem', 'Imagem não definida!');
            return false;
        }
        return true;
    }

    public function getByTitulo($titulo)
    {
        $sql = new DB();
        $r = $sql->select('SELECT * FROM `' . $this->getTable() . '` WHERE `' . $this->getTable() . '`.`titulo` = \'' . $titulo . '\'');
        if (empty($r)) {
            return $r;
        }
        return $r[0];
    }

    function getId()
    {
        return $this->data['id'];
    }

    function getTitulo()
    {
        return $this->data['titulo'];
    }

    function getDescricao()
    {
        return $this->data['descricao'];
    }

    function getPreco()
    {
        return $this->data['preco'];
    }

    function getImagem()
    {
        return $this->data['imagem'];
    }

    /**
     * 
     * @return type
     */
    function IsPersonalizado()
    {
        return $this->data['personalizado'];
    }

    function getTipo()
    {
        return $this->data['tipo'];
    }

    function getCategoria()
    {
        return $this->data['cat_id'];
    }

    function getFilho()
    {
        return $this->data['filho_id'];
    }

    function setTipo($tipo)
    {
        $this->data['tipo'] = $tipo;
    }

    function setImagem($imagem)
    {
        $this->data['imagem'] = $imagem;
    }

    function setPersonalizado($personalizado)
    {
        $this->data['personalizado'] = $personalizado;
    }

    function setCategoria($cat_id)
    {
        $this->data['cat_id'] = $cat_id;
    }

    function setPreco($preco)
    {
        $this->data['preco'] = $preco;
    }

    function setId($id)
    {
        $this->data['id'] = $id;
    }

    function setTitulo($titulo)
    {
        $this->data['titulo'] = $titulo;
    }

    function setDescricao($descricao)
    {
        $this->data['descricao'] = $descricao;
    }

    function setFilho($filho_id)
    {
        $this->data['filho_id'] = (!empty($filho_id) ? $filho_id : null);
    }

    public function getTable(): string
    {
        return $this->table;
    }
}
