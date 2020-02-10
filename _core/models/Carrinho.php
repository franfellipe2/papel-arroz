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
class Carrinho extends Model implements ModelInterface {

    CONST CAR_SESSION = 'carrinho';

    protected $data = [
        'id'           => '',
        'id_session'   => '',
        'dt_registro'  => '',
        'vltotal'      => '',
        'id_comprador' => ''
    ];
    private $table = 'carrinho';
    private $produtos;
    private $comprador;

    public function save($excludeFields = array())
    {
        parent::save($excludeFields);
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
