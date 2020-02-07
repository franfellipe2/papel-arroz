<?php
namespace app\utils;

use app\models\Categoria;

/**
 * Description of CategoriasAninhadas
 *
 * @author franf
 */
class CategoriasAninhadas {

    static $categorias = array();
    static $aninhadas = array();

    public function get()
    {
        if (empty(self::$aninhadas)) {
            $this->aninhar();
        }
        return self::$aninhadas;
    }

    private function aninhar($pai = null, $ident = '')
    {
        $ident .= '-';
        foreach ($this->getCategorias() as $r => $c) {

            if ($pai == $c['cat_pai']) {
                $c['nome'] = substr($ident, 1) . $c['nome'];
                array_push(self::$aninhadas, $c);
                $this->aninhar($c['id'], $ident);
            }
        }

        return self::$aninhadas;
    }

    private function getCategorias()
    {

        if (empty(self::$categorias)) {
            $cat = new Categoria();
            self::$categorias = $cat->listAll();
        }
        return self::$categorias;
    }
}
