<?php

namespace app\controllers\frontend;

/**
 * Description of homeController
 *
 * @author franf
 */
class homeController extends frontController {

    function __construct()
    {
        $p = new \app\models\Produto();
        $produtos = $p->getAll();       
        require $this->getFilePath('home');
    }
}
