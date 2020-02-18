<?php

namespace app\validates;

use app\models\Pessoa;

/**
 * Description of CompradorValidate
 *
 * @author franf
 */
class PessoaValidate {

    private $pessoa;
    private $errors;

    public function __construct(Pessoa $pessoa)
    {
        $this->pessoa = $pessoa;
    }

    public function getErros()
    {
        return $this->pessoa->getErrors();
    }

    public function getError($campoErro)
    {
        return $this->pessoa->getError($campoErro);
    }

    public function nome()
    {
        $v = $this->pessoa->getNome();
        if (empty($v)) {
            $this->pessoa->addError('nome', 'Nome em branco');
        } elseif (strlen($v) > 255) {
            $this->pessoa->addError('nome', 'Verifique se o nome estão correto. Existem mais de 255 caracteres');
        }
    }

    public function cpf()
    {
        $v = str_replace(['-', '.', ' '], '', $this->pessoa->getCpf());
        $this->pessoa->setCpf($v);

        if (empty($v)) {
            $this->pessoa->addError('cpf', 'CPF em branco');
        } elseif (!appValidaCPF($v)) {
            $this->pessoa->addError('cpf', 'CPF inválido');
        }
    }

    public function email()
    {
        $v = $this->pessoa->getEmail();
        if (!empty($v) && !filter_var($v, FILTER_VALIDATE_EMAIL)) {
            $this->pessoa->addError('email', 'Email inválido');
        }
    }

    public function whatssap()
    {
        $v = $this->pessoa->getWhatssap();
        $v = str_replace(['.', '-', ' ', '(', ')'], '', $v);
        if (!empty($v) && ((int) $v) <= 0) {
            $this->pessoa->addError('whatssap', 'Telefone inválido');
        }
    }
}
