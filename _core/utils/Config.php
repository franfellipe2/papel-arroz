<?php

namespace app\utils;

/**
 * Não instanciar esta classe, ao invés disso utilize a função config()
 *
 * @author franf
 */
class Config {

    private $path = 'config/';
    private $configs = array();
    private static $instance;

    private function __construct()
    {
        $this->path = __DIR__.'/../../'.$this->path;
    }

    public static function instance()
    {
        if (self::$instance == NULL) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    /**
     * 
     * @param type $file arquivo de configuração
     * @param type $index index/chave da configuração
     * @return type
     */
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
