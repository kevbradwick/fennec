<?php

require_once __DIR__ . '/../vendor/autoload.php';

$container = new \Fennec\Container('./child.yml');

/** @var DateTime $date */
$date = $container->get('date');

var_dump($date);
