<?php

namespace app\controllers\frontend;

use app\utils\Paginacao;
use app\models\PapelArroz;

/**
 * Description of homeController
 *
 * @author franf
 */
class homeController extends frontController {

    function __construct()
    {
        $p = new PapelArroz();
        $paginate = new Paginacao($p, 9, 8);
        $produtos = $p->listAll(true, $paginate->limit(), ['id', 'desc']);

        require $this->getFilePath('home');
    }
}
