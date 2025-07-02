<?php

use WebUI\Controllers\CustomerController;

$basePath = '/learning/php-aiqfome-challenge/Public';
$method = $_SERVER['REQUEST_METHOD'];
$uri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
$route = "$method $uri";

if ($method === 'GET' && preg_match('#^/customer/(\d+)$#', $uri, $matches)) {
    $id = (int) $matches[1];
    $route = 'GET /customer/{id}';
}

switch ($route) {
    case 'POST /customer':
        $controller = $container->get(CustomerController::class);
        $controller->create();
        break;
    case 'GET /customer/{id}':
        $controller = $container->get(CustomerController::class);
        $controller->getById($id);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada']);
        break;
}
