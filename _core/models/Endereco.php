<?php

namespace app\models;

use app\DB;
use app\validates\EnderecoValidate;

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

    public function save($excludeFields = array())
    {
        $validate = new EnderecoValidate($this);
        
        $validate->longradouro();
        $validate->numero();     
        $validate->complemento();
        $validate->bairro();                
        $validate->estado();        
        $validate->cidade();
        $validate->uf();
        $validate->cep();
        parent::save($excludeFields);
    }

    public function setCep($cep)
    {
        $this->data['cep'] = $cep;
    }

    public function getCep()
    {
        return $this->data['cep'];
    }

    public function setUf($uf)
    {
        $this->data['uf'] = $uf;
    }

    public function getUf()
    {
        return $this->data['uf'];
    }

    public function setEstado($estado)
    {
        $this->data['estado'] = $estado;
    }

    public function getEstado()
    {
        return $this->data['estado'];
    }

    public function setCidade($cidade)
    {
        $this->data['cidade'] = $cidade;
    }

    public function getCidade()
    {
        return $this->data['cidade'];
    }

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

    public function getLongradouro()
    {
        return $this->data['longradouro'];
    }

    /**
     * Busca no banco de dados os endereços que correspodem aos argumentos dos campos infomados
     * @param array $fields exemplo: ['longradouro' => 'Rua santos dumont', 'numero' => 65, ...]
     */
    public function getBy(array $fieldsArgs)
    {
        $db = new DB();
        $criterios = [];
        $params = [];
        foreach ($fieldsArgs as $k => $v) {
            $criterios [] = "$k = :$k";
            $params[":$k"] = $v;
        }
        $criterios = implode(' AND ', $criterios);
        $sql = 'SELECT * FROM `' . $this->getTable() . '` WHERE ' . $criterios;
        $r = $db->select($sql, $params);

        if (empty($r)) {
            return false;
        } else {
            $array = [];
            foreach ($r as $data) {
                $e = new Endereco();
                $e->setData($data);
                $array[] = $e;
            }
            return $array;
        }
    }
}
