<?php

namespace app\validates;

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
        $v = $this->objt->getLongradouro();
        if (empty($v)) {
            $this->objt->addError('longradouro', 'Endereço em branco');
        }
        return true;
    }

    public function numero()
    {
        $v = $this->objt->getNumero();        
        if (empty($v)) {
            $this->objt->addError('numero', 'Número em branco');
        } elseif (( (int) $v ) <= 0) {
            $this->objt->addError('numero', 'Número inválido');
        }
        return true;
    }

    public function complemento()
    {
        $v = $this->objt->getComplemento();
        if (strlen($v) > 60) {
            $this->objt->addError('complemento', 'Complemento maior que 60 caracteres!');
        }
        return true;
    }

    public function bairro()
    {
        $v = $this->objt->getBairro();
        if (empty($v)) {
            $this->objt->addError('bairro', 'Bairro em branco!');
        } elseif (strlen($v) > 255) {
            $this->objt->addError('bairro', 'Bairro inválido!');
        }
        return true;
    }

    public function cidade()
    {
        $v = $this->objt->getCidade();
        if (empty($v)) {
            $this->objt->addError('cidade', 'Cidade em branco!');
        } elseif (strlen($v) > 255) {
            $this->objt->addError('cidade', 'Cidade inválida!');
        }
        return true;
    }

    public function estado()
    {
        $v = $this->objt->getEstado();
        if (empty($v)) {
            $this->objt->addError('estado', 'Estado em branco!');
        } elseif (strlen($v) > 120) {
            $this->objt->addError('estado', 'Estado inválido!');
        }
        return true;
    }

    public function uf()
    {
        $v = $this->objt->getUf();
        if (empty($v)) {
            $this->objt->addError('uf', 'UF em branco!');
        } elseif (strlen($v) > 120) {
            $this->objt->addError('uf', 'UF inválido!');
        }
        return true;
    }

    public function cep()
    {
        $v = $this->objt->getCep();
        if (empty($v)) {
            $this->objt->addError('cep', 'CEP em branco!');
        } elseif (!appValidaCep($v)) {
            $this->objt->addError('cep', 'cep inválido!');
        }
        return true;
    }
}
