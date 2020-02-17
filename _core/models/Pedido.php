<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of Pedido
 *
 * @author franf
 */
class Pedido extends Model {

    protected $data = [
        'id'             => null,
        'id_carrinho'    => null,
        'id_pessoa'      => null,
        'id_endereco'    => null,
        'vl_total'       => null,
        'recebido'       => null,
        'em_producao'    => null,
        'pronto_entrega' => null,
        'enviado'        => null,
        'entregue'       => null
    ];
    protected $table = 'pessoas';

    public function setStatus($tipo, $date)
    {
        $this->data[$tipo] = $date;
    }

    public function getStatus()
    {
        return [
            'recebido'       => $this->data['recebido'],
            'em_producao'    => $this->data['em_producao'],
            'pronto_entrega' => $this->data['pronto_entrega'],
            'enviado'        => $this->data['enviado'],
            'entregue'       => $this->data['entregue']
        ];
    }

    public function setIdEndereco($idEndereco)
    {
        $this->data['id_endereco'] = $idEndereco;
    }

    public function getIdEndereco()
    {
        return $this->data['id_endereco'];
    }

    public function setVltotal($vl_total)
    {
        $this->data['vl_total'] = $vl_total;
    }

    public function getVltotal()
    {
        return $this->data['vl_total'];
    }

    public function setDtRegistro($dt_registro)
    {
        $this->data['dt_registro'] = $dt_registro;
    }

    public function getDtRegistro()
    {
        return $this->data['dt_registro'];
    }

    public function setEntregaStatus($entrega_status)
    {
        $this->data['entrega_status'] = $entrega_status;
    }

    public function getEntregaStatus()
    {
        return $this->data['entrega_status'];
    }

    public function setPedidoStatus($pedido_status)
    {
        $this->data['pedido_status'] = $pedido_status;
    }

    public function getPedidoStatus()
    {
        return $this->data['pedido_status'];
    }

    public function setIdpessoa($id_pessoa)
    {
        $this->data['id_pessoa'] = $id_pessoa;
    }

    public function getIdpessoa($id_pessoa)
    {
        return $this->data['id_pessoa'];
    }

    public function getIdCarrinho()
    {
        return $this->data['id_carrinho'];
    }

    public function setIdCarrinho($idCarrinho)
    {
        $this->data['id_carrinho'] = $idCarrinho;
    }
}
