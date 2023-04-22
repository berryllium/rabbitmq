<?php

use Dima\Rabbitmq\Producer;

require_once '../vendor/autoload.php';

$testProducer = new Producer('messages');
$testProducer->send('Hello, developer ;-)');