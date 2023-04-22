<?php

use Dima\Rabbitmq\Consumer;

require_once '../vendor/autoload.php';

$consumer = new Consumer('messages');
$consumer->watch();