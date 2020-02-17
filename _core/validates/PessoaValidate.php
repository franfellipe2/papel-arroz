<?php

use app\models\Pessoa;

/**
 * Description of CompradorValidate
 *
 * @author franf
 */
class PessoaValidate {

    private $pessoa;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }
 
    public function nome()
    {
        $v = $this->pessoa->getNome();
        if (!empty($v)) {
            return 'Nome não pode estar em branco';
        } elseif (strlen($v) > 255) {
            return 'Verifique se o nome estão correto. Existem mais de 255 caracteres';
        }
        return true;
    }

    public function cpf()
    {
        $v = $this->pessoa->getCpf();
        if (!empty($v)) {
            return 'CPF não pode estar em branco';
        } elseif (!appValidaCPF($v)) {
            return 'CPF inválido';
        }
        return true;
    }

    public function email()
    {
        $v = $this->pessoa->getEmail();
        if (!filter_var($v, FILTER_VALIDATE_EMAIL)) {
            return 'Email inválido';
        }
        return true;
    }

    public function whatssap()
    {
        $v = $this->pessoa->getWhatssap();
        $v = str_replace(['.', '-', ' ', '(', ')'], '', $v);
        if (((int) $v) <= 0) {
            return 'Telefone inválido';
        }
        return true;
    }
}
