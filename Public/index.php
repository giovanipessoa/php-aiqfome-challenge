<?php

require_once __DIR__ . '/../vendor/autoload.php';

use DI\ContainerBuilder;

// global handler
header('Content-Type: application/json');

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/../Infra/IoC/DependencyInjection.php');
$container = $containerBuilder->build();

// main routes
require_once __DIR__ . '/../Routes/routes.php';
