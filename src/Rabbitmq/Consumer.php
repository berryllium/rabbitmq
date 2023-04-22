<?php
namespace Dima\Rabbitmq;

class Consumer {
    private $queue;

    public function __construct($queue)
    {
        $this->queue = $queue;
    }

    private function callback($msg) {
        dump($msg->body);
    }

    public function watch()
    {
        $connection = Connection::getInstatnce()->getConnection();
        $channel = $connection->channel();
        $channel->queue_declare($this->queue, false, false, false, false);    
        
        $channel->basic_consume($this->queue, '', false, true, false, false, function($msg){
            $this->callback($msg);
        });

        while($channel->is_open()) {
            $channel->wait();
        }

        $channel->close();
    }
}