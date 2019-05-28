<?php

use Prometheus\CollectorRegistry;

require_once __DIR__ . '/vendor/autoload.php';

$adapter = new Prometheus\Storage\InMemory();
$registry = new CollectorRegistry($adapter);
$counter = $registry->registerCounter('test', 'some_counter', 'it increases', ['type', 'color']);
$count = rand(0, 10);
echo $count;
$counter->incBy($count, ['blue', 'red']);
$pushGateway = new \Prometheus\PushGateway('localhost:9091');
$pushGateway->push($registry, 'my_job', ['instance'=>'foo']);