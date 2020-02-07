<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../_core/model/Produto.php';

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
