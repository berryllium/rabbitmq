<?php
namespace Dima\Rabbitmq;

use PhpAmqpLib\Message\AMQPMessage;

class Producer {
    private $queue;

    public function __construct($queue)
    {
        $this->queue = $queue;
    }

    public function send(string|array $messages = 'Hello!') 
    {
        $connection = Connection::getInstatnce()->getConnection();
        $channel = $connection->channel();
        $channel->queue_declare($this->queue, false, false, false, false);
        if(!is_array($messages)) {
            $messages = [$messages];
        }
        
        foreach ($messages as $message) {
            $msg = new AMQPMessage($message);
            $channel->basic_publish($msg, '', $this->queue);
        }
        
        $channel->close();
    }
}