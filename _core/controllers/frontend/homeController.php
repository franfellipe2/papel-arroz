<?php

namespace app\controllers\frontend;

use app\utils\Paginacao;

/**
 * Description of homeController
 *
 * @author franf
 */
class homeController extends frontController {

    function __construct()
    {
        $p = new \app\models\PapelArroz();
        $currentPage = ($pg = filter_input(INPUT_GET, 'paginate')) ? $pg : 1;
        $paginate = new Paginacao($p, 6, 8, (int) $currentPage);        
        $produtos = $p->listAll(true, $paginate->limit(), ['id', 'desc']);
        
        require $this->getFilePath('home');
    }
}
