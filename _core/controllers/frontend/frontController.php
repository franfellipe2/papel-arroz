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

    private $request;
    private $response;

    public function __construct($request, $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    function getRequest()
    {
        return $this->request;
    }

    function getResponse()
    {
        return $this->response;
    }

    public function getFilePath($filename)
    {
        return appConfig('frontDir') . $filename . '.php';
    }

    public function getPage404()
    {
        require $this->getFilePath('404');
    }
}
