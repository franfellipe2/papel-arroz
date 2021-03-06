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

    CONST SESSION = 'carrinho';

    protected $data = [
        'id'             => '',
        'id_session'     => '',
        'dt_registro'    => null,
        'total_produtos' => 0,
        'preco_total'    => 0,
    ];
    protected $table = 'carrinho';
    private $itens = array();

    /**
     * Verifica se existe um carrinho válido na sessão
     */
    public static function hasSessionValid()
    {
        $car = new self;
        // Verfica se o carrinho já existe na seção
        return ($d = $car->getSession()) && !empty($d['id']);
    }

    public function getProdutos()
    {
        $db = new DB();
        $result = $db->select('SELECT * FROM produtos
                                        INNER JOIN prod_carrinho
                                        ON produtos.`id` = prod_carrinho.id_produto
                                        WHERE prod_carrinho.id_carrinho = :idc
                                        AND prod_carrinho.dtdelete IS NULL
                                        GROUP BY produtos.id', [
            ':idc' => $this->getId()
        ]);

        return isset($result) ? $result : array();
    }

    public function minusProduto($produtoId)
    {
        $db = new DB();
        $result = $db->select('SELECT produtos.*, prod_carrinho.quantidade, prod_carrinho.id_produto FROM prod_carrinho  
                                        INNER JOIN produtos
                                        ON prod_carrinho.id_produto = produtos.id
                                        WHERE prod_carrinho.id_carrinho = :idc 
                                        AND prod_carrinho.id_produto = :idp', [
            ':idc' => $this->getId(),
            ':idp' => (int) $produtoId
        ]);

        $qtd = $result[0]['quantidade'];

        if (empty($result)) {
            return false;
        } elseif ($qtd > 1) {
            $p = new Produto;
            $p->setData($result[0]);
            $this->updateProduto($p, $qtd - 1);
        } else {
            $this->removeProduto($produtoId);
        }
    }

    public function getProduto($produtoId, $deleted = false)
    {
        $db = new DB();
        $d = !$deleted ? ' AND dtdelete IS NULL ' : '';
        $result = $db->select('SELECT * FROM produtos
                                        INNER JOIN prod_carrinho
                                        ON produtos.`id` = prod_carrinho.id_produto
                                        WHERE prod_carrinho.id_carrinho = :idc 
                                        AND prod_carrinho.id_produto = :idp
                                        ' . $d, [
            ':idc' => $this->getId(),
            ':idp' => (int) $produtoId
        ]);

        return !empty($result) ? $result[0] : false;
    }

    public function hasProduto(Produto $p)
    {
        $db = new DB();
        $result = $db->select('SELECT id_produto FROM prod_carrinho WHERE id_produto = :idp AND id_carrinho = :idc', [':idp' => $p->getId(), ':idc' => $this->getId()]);
        return !empty($result);
    }

    public function InsertProduto(Produto $p, $qtd, $desconto = 0, $juros = 0)
    {
        $db = new DB();
        $db->query('INSERT INTO prod_carrinho ( id_produto, id_carrinho,  quantidade, desconto, juros, preco_venda, vltotal )
                                       VALUES(:id_produto, :id_carrinho,  :quantidade, :desconto, :juros, :preco_venda, :vltotal)', [
            ':id_produto'  => $p->getId(),
            ':id_carrinho' => $this->getId(),
            ':quantidade'  => $qtd,
            ':desconto'    => (float) $desconto,
            ':juros'       => (float) $juros,
            ':preco_venda' => (float) $p->getPreco(),
            ':vltotal'     => $this->calculateTotal($qtd, $p->getPreco(), $desconto, $juros)
        ]);
    }

    public function updateProduto(Produto $p, $qtd, $desconto = 0, $juros = 0)
    {
        $db = new DB();
        $db->query('UPDATE prod_carrinho SET quantidade = :quantidade,
                                             desconto = :desconto, 
                                             juros = :juros, 
                                             vltotal = :vltotal,
                                             dtdelete = :dtdelete
                                             WHERE id_produto = :id_produto AND id_carrinho = :id_carrinho', [
            ':id_produto'  => $p->getId(),
            ':id_carrinho' => $this->getId(),
            ':quantidade'  => $qtd,
            ':desconto'    => (float) $desconto,
            ':juros'       => (float) $juros,
            ':dtdelete'    => NULL,
            ':vltotal'     => $this->calculateTotal($qtd, $p->getPreco(), $desconto, $juros)
        ]);
    }

    public function removeProduto($produtoId)
    {
        $db = new DB();

        return $db->query('UPDATE prod_carrinho SET dtdelete = :now, quantidade = 0, vltotal = 0
                           WHERE prod_carrinho.id_produto = :idp
                           AND prod_carrinho.id_carrinho = :idc', [
                    ':idp' => $produtoId,
                    ':idc' => $this->getId(),
                    ':now' => date('Y-m-d H:i:s', time()),
        ]);
    }

    public function calculateTotal($qtd, $preco, $desconto, $juros)
    {
        return (($qtd * $preco ) - $desconto) * (($juros / 100) + 1);
    }

    public function create()
    {
        $this->setIdSession(session_id());
        $this->setDtRegistro(date('Y-m-d H:i:s', time()));
        unset($this->data['total_produtos']);
        unset($this->data['preco_carrinho']);
        parent::save();
        $_SESSION[self::SESSION] = $this->getData();
    }
    // ============================================================
    // GETERS
    // ============================================================

    /**
     * Pega o carrinho da sessação. Se $create for true, ele cria se não existir carrinho na sessão
     * @param boolean $create Se não tiver um carrinho na seção, cria
     * @return Carrinho
     */
    public static function getFromSession($create = true)
    {
        $car = new Carrinho;

        // Verfica se o carrinho já existe na seção
        if (($d = $car->getSession()) && !empty($d['id'])) {
            $car->setData($d);
        } elseif (($c = $car->getByIdSession()) && !empty($c->getId())) {
            $car = $car->getByIdSession();
        } elseif ($create) {
            $car->create();
        }
        return $car;
    }

    public function setTotalProdutos($qtd)
    {
        $this->data['total_produtos'] = $qtd;
    }

    public function getTotalProdutos()
    {
        return isset($this->data['total_produtos']) ? $this->data['total_produtos'] : 0;
    }

    public function getPrecoCarrinho()
    {
        return isset($this->data['preco_carrinho']) ? $this->data['preco_carrinho'] : 0;
    }

    public function getByIdSession()
    {
        $db = new DB();
        $result = $db->select("SELECT a.*, SUM(b.quantidade) as total_produtos, SUM(b.vltotal) as preco_carrinho                        
                               FROM `{$this->getTable()}` as a
                               INNER JOIN  prod_carrinho as b
                               ON a.id = b.id_carrinho 
                               WHERE id_session = :id_session", array(':id_session' => session_id()));
        if (!empty($result)) {
            $_SESSION[self::SESSION] = $result[0];
            $this->setData($result[0]);
            return $this;
        }
        return false;
    }

    public function getById($id)
    {
        $db = new DB();
        $result = $db->select("SELECT a.*, SUM(b.quantidade) as total_produtos, SUM(b.vltotal) as preco_carrinho                        
                               FROM `{$this->getTable()}` as a
                               INNER JOIN  prod_carrinho as b
                               ON a.id = b.id_carrinho 
                               WHERE id = :id", array(':id' => $id));

        if (!empty($result) && !empty($result[0]['id'])) {
            $this->setData($result[0]);
            return $this;
        }
        return false;
    }

    public function getSession()
    {
        if (isset($_SESSION[self::SESSION])) {
            return $_SESSION[self::SESSION];
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
        return $this->data['preco_carrinho'];
    }

    function getId()
    {
        return $this->data['id'];
    }

    // ============================================================
    // SETERS
    // ============================================================
    public function setToSession()
    {
        $_SESSION[self::SESSION] = $this->getData();
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

//cascunho------------------------------------------------------------>>>>

