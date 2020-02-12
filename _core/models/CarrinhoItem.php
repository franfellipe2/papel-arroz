<?php

namespace app\models;

use app\models\Model;

/**
 * Description of CarrinhoItem
 *
 * @author franf
 */
class CarrinhoItem extends Model {

    protected $table = 'prod_carrinho';
    private $produto;
    private $carrinho;
    private $data = [
        'id'          => null,
        'id_produto'  => null,
        'id_carrinho' => null,
        'quantidade'  => 0,
        'desconto'    => 0,
        'juros'       => 0,
        'vltotal'     => 0
    ];

    public function __construct(Carrinho $carrinho, Produto $produto)
    {
        $this->produto = $produto;
        $this->carrinho = $carrinho;        
    }

    /**
     * Calcula, seta e retorna o valor total
     * @return type
     */
    public function calcTotal()
    {

        $p = $this->produto->getPreco();
        $q = $this->data['quantidade'];
        $d = $this->data['desconto'];
        $tb = ( $p * $q); // total bruto
        $tj = $this->data['juros'] / 100 * $tb; // total juros          

        $tl = $tb + $tj - $d;   // total liquido

        return $this->data['vltotal'] = $tl;
    }

    public function add()
    {
        $this->calcTotal();
        $this->setData([
            'id_produto'  => $this->produto->getId(),
            'id_carrinho' => $this->carrinho->getId()
        ]);
        parent::save();
    }
}
