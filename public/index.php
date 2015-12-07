<?php

define('APPLICATION_ROOT_DIR', realpath(__DIR__ . '/../') . '/');

require_once APPLICATION_ROOT_DIR . '/vendor/autoload.php';

use Sainsburys\HttpService\Application;
use UltraLite\Container\Container;

$diContainer = new Container();
$diContainer->configureFromFile(APPLICATION_ROOT_DIR . '/config/di.php');

$application = Application::factory([APPLICATION_ROOT_DIR . '/config/routing.php'], $diContainer);
$application->run();
