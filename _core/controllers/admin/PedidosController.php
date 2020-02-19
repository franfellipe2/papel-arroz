<?php

namespace app\controllers\admin;

/**
 * Description of CategoriaController
 *
 * @author franf
 */
class PedidosController extends AdminController {

    private $page = 'Pedidos';

    /**
     * 
     */
    public function listar()
    {
        require $this->page . '/listar.php';
    }

    /**
     * 
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }
}
