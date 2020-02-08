<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers\frontend;

/**
 * Description of frontController
 *
 * @author franf
 */
class frontController {

    public function getFilePath($filename)
    {
        return appConfig('frontDir') . $filename . '.php';
    }
    
    
   
}
