<?php

namespace app\controllers\frontend;

/**
 * Description of homeController
 *
 * @author franf
 */
class homeController extends frontController{

    function __construct()
    {
        require $this->getFilePath('home');       
    }    
    
}
