<?php

namespace app\utils;

/**
 * Description of MensageFromSession
 *
 * @author franf
 */
class MensageFromSession {

    const MENSAGE_FROM_SESSION = 'MENSAGE_FROM_SESSION';
    const TYPE_SUCCESSS = 'success';
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';
    const TYPE_ALERT = 'alert';

    static function all()
    {
        return $_SESSION[self::MENSAGE_FROM_SESSION];
    }

    /**
     * Adcionona mensagem
     * @param type $tipo constante TYPE_ dessa classe
     * @param type $text
     */
    static function add($tipo, $text)
    {
        $_SESSION[self::MENSAGE_FROM_SESSION][$tipo] = $text;
    }
    /*
     * Pega uma mensagem de erro
     */

    static function get($tipo)
    {
        if (isset($_SESSION[self::MENSAGE_FROM_SESSION][$tipo])) {
            return $_SESSION[self::MENSAGE_FROM_SESSION][$tipo];
        }
        return false;
    }

    /**
     * Retorna uma mensagem e a remove da sessão
     */
    static function getRemove($tipo)
    {
        $msg = $this->get($tipo);
        $this->remove($tipo);
        return $msg;
    }

    /**
     * Remove uma mensagem de erro
     * @param type $tipo
     */
    static function remove($tipo)
    {
        if (isset($_SESSION[self::MENSAGE_FROM_SESSION][$tipo])) {
            unset($_SESSION[self::MENSAGE_FROM_SESSION][$tipo]);
        }
    }

    /**
     * Apaga todoas as mensagens de erro
     */
    static function clear()
    {
        $_SESSION[self::MENSAGE_FROM_SESSION] = array();
    }
}
