<?php

namespace app\controllers\admin;

use app\models\Pedido;

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
        $pedidos = (new Pedido())->listAll();
        require $this->page . '/listar.php';
    }

    /**
     * 
     */
    public function mostrar()
    {
        $pedido = (new Pedido)->getById(filter_input(INPUT_GET, 'id'));        
        require $this->page . '/mostrar.php';
    }

    /**
     * 
     * @return string
     */
    public function getPage(): string
    {
        return $this->page;
    }

    public function checkStatus()
    {
        $status = $_GET['status'];
        $pedidoId = filter_input(INPUT_GET, 'pedido-id');
        $pedido = (new Pedido)->getById($pedidoId);
        if (empty($pedido->getStatus($status))) {
            $pedido->setStatus($status, date('y-m-d H:i:s', time()));
        } else {
            $pedido->setStatus($status, null);
        }
        $pedido->save();

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
