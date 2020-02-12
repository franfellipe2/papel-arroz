<?php

namespace app\models;

use app\models\Model;
use app\interfaces\ModelInterface;
use app\DB;
use app\models\Produto;
use app\models\Pessoa;

/**
 * Description of Categoria
 *
 * @author franf
 */
class Carrinho extends Model implements ModelInterface {

    CONST CAR_SESSION = 'carrinho';

    protected $data = [
        'id'          => '',
        'id_session'  => '',
        'dt_registro' => null,
        'vltotal'     => 0,
    ];
    protected $table = 'carrinho';
    private $itens;
    private $cliente;

    public function __construct()
    {

        if (!$this->existisCar()) {
            $this->save();
        }
    }

    function save($excludeFields = array())
    {
        $this->data['id_session'] = session_id();
        $this->data['dt_registro'] = date('Y-m-d H:i:s', time());
        parent::save($excludeFields);
    }

    public function calcValorTotal()
    {
        foreach ($this->produtos as $p):
            $this->data['vltotal'] += $p->vltotal();
        endforeach;
    }

    /**
     * Adicionar produto ao carrinho
     * @param Produto $protudo
     */
    public function addProduto(Produto $protudo = null)
    {
        $this->carrinhoItem->add($protudo);
    }

    /**
     * Verfica se o carrinho existe
     * @return type
     */
    public function existisCar()
    {
        return isset($_SESSION[self::CAR_SESSION]['id']);
    }

    /**
     * Retornas todos os produtos
     */
    public function getProdutos()
    {
        $db = new DB();
        $sql = 'SELECT * FROM `produtos` 
                INNER JOIN prod_carrinho p
                ON p.id_produto = `produtos`.`id`
                AND p.id_carrinho = :id';

        $r = $db->select($sql, [':id' => $this->getId()]);

        foreach ($r as $p => $data) {
            $p = new Produto();
            $p->setData($data);
            $this->produtos[] = $p;
        }

        return $this->produtos;
    }

    public function getComprador()
    {
        $db = new DB();
        $sql = 'SELECT * FROM `compradores` WHERE `compradores`.`id` = :id';
        $r = $db->select($sql, [':id' => $this->getId()]);

        if (!empty($r[0])) {
            $this->comprador = new Comprador();
            $this->comprador->setData($r[0]);
            return $this->comprador;
        } else {
            return false;
        }
    }
}
