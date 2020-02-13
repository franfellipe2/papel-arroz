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

    public function create()
    {
        $this->setIdSession(session_id());
        $this->setDtRegistro(date('Y-m-d H:i:s', time()));
        $this->save();
    }

    // ============================================================
    // GETERS
    // ============================================================

    public function get()
    {
        if (($c = $this->getFromSession())) {
            return $c;
        } else {
            if (($c = $this->getByIdSession())) {
                $this->setToSession($c);
            } else {
                $this->create();
                $this->setToSession($this);
            }
        }        
        return $this->getFromSession();
    }

    public function getFromSession()
    {
        if (isset($_SESSION[self::CAR_SESSION])) {
            $c = unserialize($_SESSION[self::CAR_SESSION]);
            if (empty($c->getId())) {
                return false;
            }
            return $c;
        }
        return false;
    }

    public function getByIdSession()
    {
        $db = new DB();
        $r = $db->select('SELECT * FROM `' . $this->getTable() . '` WHERE id_session = :id', array(':id' => session_id()));

        if (!empty($r)) {
            $this->setData($r[0]);
            return $this;
        } else {
            return false;
        }
    }

    function getId_session()
    {
        return $this->data['id_session'];
    }

    function getDt_registro()
    {
        return $this->data['dt_registro'];
    }

    function getVltotal()
    {
        return $this->data['vltotal'];
    }

    function getId()
    {
        return $this->data['id'];
    }

    // ============================================================
    // SETERS
    // ============================================================
    public function setToSession($carrinho)
    {
        $_SESSION[self::CAR_SESSION] = serialize($carrinho);
    }

    function setIdSession($id_session)
    {
        $this->data['id_session'] = $id_session;
    }

    function setDtRegistro($dt_registro)
    {
        $this->data['dt_registro'] = $dt_registro;
    }

    function setVltotal($vltotal)
    {
        $this->data['vltotal'] = $vltotal;
    }

    function setId($id)
    {
        $this->data['id'] = $id;
    }

    function setTable($table)
    {
        $this->table = $table;
    }
}
