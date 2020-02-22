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
        $p = new \app\models\PapelArroz();
        $produtos = $p->listAll();       
        require $this->getFilePath('home');
    }
}
