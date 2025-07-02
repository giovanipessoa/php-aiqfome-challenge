<?php

use WebUI\Controllers\CustomerController;

$basePath = '/learning/php-aiqfome-challenge/Public';
$requestUri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

switch ("$method $requestUri") {
    case 'POST /customer/create':
        $controller = $container->get(CustomerController::class);
        $controller->create();
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada']);
        break;
}
