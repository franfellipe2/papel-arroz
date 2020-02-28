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
        'personalizado' => 0,
        'tipo'          => '',
        'filho_id'      => null
    ];
    private $cat_ids_form = array();
    private $table = 'produtos';

    public function getSearch($text, $limit = array())
    {
        $db = new DB();

        $params = [':text' => "%$text%"];
        $args = '';
        if (!empty($limit)) {
            $args .= ' LIMIT :start, :offset';
            $params[':start'] = $limit[0];
            $params[':offset'] = $limit[1];
        }

        $sql = 'SELECT * FROM produtos WHERE titulo LIKE :text ' . $args;
        $r = $db->select($sql, $params);
        if ($r) {
            $produtos = array();
            foreach ($r as $data) {
                $p = new Produto();
                $p->setData($data);
                $produtos[] = $p;
            }
            return $produtos;
        } else {
            return false;
        }
    }

    public function save($excludeFields = array())
    {
        $db = new DB();
        $db->getPDO()->beginTransaction();
        $this->validTitulo();
        $this->validDescricao();
        $this->validPreco();
        $this->validImagem();
        $this->validCategorias();
        $this->validPersonalizado();
        $this->setSlug($this->getTitulo());

        try {
            parent::save($excludeFields) ? false : true;
            $this->deleteCategorias();
            $this->saveCategorias() ? false : true;
        } catch (\PDOException $ex) {
            $db->getPDO()->rollBack();
            print "Erro!: " . $ex->getMessage() . "</br>";
        }
        $db->getPDO()->commit();
        return true;
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

    public function deleteCategorias($ids = array())
    {
        $db = new DB();
        $db->query('DELETE FROM prod_cat WHERE prod_cat.prod_id = :id', [':id' => $this->getId()]);
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

    public function validCategorias()
    {
        if (empty($this->getCatIdsForm())) {
            $this->addError('cat_ids_form', 'Categoria não definida!');
            return false;
        }
        foreach ($this->getCategorias() as $id) {
            if (((int) $id) == 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Pega os ids das categorias informados no formulário de cadastro ou atualização
     * 
     */
    function getCatIdsForm()
    {
        return $this->cat_ids_form;
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

    public function saveCategorias()
    {
        if ($this->errorExistis()) {
            return false;
        }
        $db = new DB();
        $sql = 'INSERT INTO prod_cat (prod_id, cat_id) VALUES ';
        $params = [':p' => $this->getId()];
        $cs = $this->getCatIdsForm();
        for ($i = 0; $i < count($cs); $i++) {
            $pc = ":c{$i}";
            $sql .= "( :p, $pc ), ";
            $params[$pc] = $cs[$i];
        }
        $sql = substr($sql, 0, -2);
        $db->query($sql, $params);
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

    function getCategorias()
    {
        $sql = new DB();
        $rsql = 'SELECT * FROM `categorias` 
                 INNER JOIN prod_cat 
                 ON `prod_cat`.`cat_id` = categorias.id
                 AND prod_cat.prod_id = :id';
        $r = $sql->select($rsql, [':id' => $this->getId()]);
        if (empty($r)) {
            return $r;
        }
        return $r;
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

    public function getPersonalizado()
    {
        return $this->data['personalizado'];
    }

    /**
     * Seta os ids das categorias informados no formulario para cadastro ou atualização
     */
    function setCatIdsForm($ids)
    {
        if (is_array($ids)) {
            $this->cat_ids_form = $ids;
        } elseif ($ids != null) {
            $this->cat_ids_form[] = $ids;
        }
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
