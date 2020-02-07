<?php
namespace app\controllers\admin;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControlerAdmin
 *
 * @author franf
 */
class AdminController {

    public function pageAction($action, $params = array())
    {
       $ps = '';
       foreach($params as $k => $v){
           $ps .= "&$k=$v";
       }       
       return '?pg=' . $this->getPage() . '&action=' . $action.$ps;
    }    
    
}
