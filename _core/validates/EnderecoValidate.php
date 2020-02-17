<?php

use app\models\Endereco;

/**
 * Description of CompradorValidate
 *
 * @author franf
 */
class EnderecoValidate {

    private $objt;

    public function __construct(Endereco $obj)
    {
        $this->objt = $obj;
    }

    public function longradouro()
    {
        $v = $this->objt->getBairro();
        if (!empty($v)) {
            return 'Endereço em branco';
        }
        return true;
    }

    public function numero()
    {
        $v = $this->objt->getNumero();
        if (!empty($v)) {
            return 'Número em branco';
        } elseif (( (int) $v ) <= 0) {
            return 'Número inválido';
        }
        return true;
    }

    public function complemento()
    {
        $v = $this->objt->getComplemento();
        if (strlen($v) > 60) {
            return 'Complemento maior que 60 caracteres!';
        }
        return true;
    }

    public function bairro()
    {
        $v = $this->objt->getBairro();
        if (!empty($v)) {
            return 'Bairro em branco!';
        } elseif (strlen($v) > 255) {
            return 'Bairro inválido!';
        }
        return true;
    }

    public function cidade()
    {
        $v = $this->objt->getCidade();
        if (!empty($v)) {
            return 'Cidade em branco!';
        } elseif (strlen($v) > 255) {
            return 'Cidade inválida!';
        }
        return true;
    }

    public function estado()
    {
        $v = $this->objt->getEstado();
        if (!empty($v)) {
            return 'Estado em branco!';
        } elseif (strlen($v) > 120) {
            return 'Estado inválido!';
        }
        return true;
    }

    public function uf()
    {
        $v = $this->objt->getUf();
        if (!empty($v)) {
            return 'UF em branco!';
        } elseif (strlen($v) > 120) {
            return 'UF inválido!';
        }
        return true;
    }

    public function cep()
    {
        $v = $this->objt->getCep();
        if (!empty($v)) {
            return 'CEP em branco!';
        } elseif (!appValidaCep($v)) {
            return 'cep inválido!';
        }
        return true;
    }
}
