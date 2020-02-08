<?php

namespace app\utils;

/**
 * Não instanciar esta classe, ao invés disso utilize a função config()
 *
 * @author franf
 */
class Config {

    private $path = '../config/';
    private $configs = array();
    private static $instance;

    private function __construct()
    {
        
    }

    public static function instance()
    {
        if (self::$instance == NULL) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function get($file, $index)
    {
        $c = $this->getAll($file);
        return $c[$index];
    }

    public function getAll($file)
    {
        if (!in_array($file, $this->configs)) {
            $this->configs[$file] = require $this->path . $file . '.php';
        }

        return $this->configs[$file];
    }
}
