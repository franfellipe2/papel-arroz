<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

use app\models\Carrinho;
use app\models\Pedido;

/**
 * Description of PedidoController
 *
 * @author franf
 */
class PedidoController extends frontController {

    public function fechar()
    {
        $carrinho = Carrinho::getFromSession(false);
        if (!$carrinho->getId()) {
            header('Location: ' . appUrl('/'));
            die();
        }
        require $this->getFilePath('fechar-pedido');
    }
}
