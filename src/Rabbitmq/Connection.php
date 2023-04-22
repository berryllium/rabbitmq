<?php

namespace Dima\Rabbitmq;

use Dima\Config;
use PhpAmqpLib\Connection\AMQPStreamConnection;

class Connection {
    private static $instance;
    private $connection;

    private function __construct() {
        $config = Config::getInstance();
        $this->connection = new AMQPStreamConnection(
            $config->get('mq_host'), 
            $config->get('mq_port'),
            $config->get('mq_login'),
            $config->get('mq_password')
        );
    }

    public function getConnection(): AMQPStreamConnection {
        return $this->connection;
    }

    public static function getInstatnce() {
        if(self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }
}