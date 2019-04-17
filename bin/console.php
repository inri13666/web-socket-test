<?php

require_once './vendor/autoload.php';

use Symfony\Component\Console\Application;

$application = new Application();

$application->add(new \Akuma\Tools\WebSocketBenchmark\Command\TestConnectionLimitCommand());

$application->run();
