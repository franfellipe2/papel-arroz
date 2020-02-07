<?php
namespace app\models;

use app\models\Produto;

/**
 * Description of PapelArroz
 *
 * @author franf
 */
class PapelArroz extends Produto {

    public function __construct()
    {
        $this->data['tipo'] = 'papel_arroz';        
    }
}
