<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

/**
 * Description of Endereco
 *
 * @author franf
 */
class Endereco extends Model {

    protected $table = 'enderecos';
    protected $data = [
        'id'          => null,
        'longradouro' => null,
        'numero'      => null,
        'complemento' => null,
        'bairro'      => null,
        'cidade'      => 'frutal',
        'estado'      => 'Minas Gerais',
        'uf'          => 'mg',
        'cep'         => '38200-000'
    ];

    public function setBairro($bairro)
    {
        $this->data['bairro'] = $bairro;
    }

    public function getBairro()
    {
        return $this->data['bairro'];
    }

    public function setComplemento($complemento)
    {
        $this->data['complemento'] = $complemento;
    }

    public function getComplemento()
    {
        return $this->data['complemento'];
    }

    public function setNumero($numero)
    {
        $this->data['numero'] = $numero;
    }

    public function getNumero()
    {
        return $this->data['numero'];
    }

    public function setLongradouro($longradouro)
    {
        $this->data['longradouro'] = $longradouro;
    }

    public function get()
    {
        return $this->data['longradouro'];
    }
}
