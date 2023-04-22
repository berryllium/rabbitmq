<?php
namespace Dima;

class Config {
    private static $instance;
    private $config;

    private function __construct()
    {
        $this->config = json_decode(file_get_contents('../config.json'),true);
    }
    
    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get($name) {
        return $this->config[$name];
    }
}