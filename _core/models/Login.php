<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;

use app\DB;
use app\models\Model;

/**
 * Description of Login
 *
 * @author franf
 */
class Login extends Model {

    protected $data = [
        'id'       => null,
        'name'     => null,
        'email'    => null,
        'password' => null,
        'admin'    => null
    ];

    const TABLE = 'usuarios';
    const SESSION = 'user';

    public function getByEmail($email)
    {
        $db = new DB();
        $r = $db->select('SELECT * FROM `' . self::TABLE . '` WHERE email = :email', [':email' => $email]);
        if (!empty($r)) {
            $login = new Login();
            $login->setData($r[0]);
            return $login;
        }
        return false;
    }

    public function entrar($email, $senha)
    {
        $user = $this->getByEmail($email);

        if ($user && password_verify($senha, $user->data['senha'])) {
            $_SESSION[self::SESSION] = $user->getData();
            return true;
        } else {
            $this->addError('error', 'Email e/ou senha inválida!');
            return false;
        }
    }

    /**
     * Verifica se existe usuário logado
     * @param boolean $isAdmin verificar se o usuário é um administrador
     */
    static function checkLogin($isAdmin = true)
    {
        if (!isset($_SESSION[self::SESSION])) {
            return false;
        }
        if ($isAdmin && (bool) $_SESSION[self::SESSION]['admin'] == false) {
            return false;
        }

        return true;
    }

    static function logout()
    {
        unset($_SESSION[Login::SESSION]);
    }
}
