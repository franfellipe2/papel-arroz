<?php
namespace app;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of config
 *
 * @author franf
 */
class config {

    static $instance;
    static $config;

    private function __construct()
    {
        self::$config = require '../config/app.php';
    }

    static public function instance(): self
    {
        if (self::$instance == NULL) {

            self::$instance = new self;
        }

        return self::$instance;
    }

    public function getConfig()
    {
        return self::$config;
    }
}
