<?php

use WebUI\Controllers\AuthController;
use WebUI\Controllers\CustomerController;
use WebUI\Middlewares\AuthMiddleware;

$basePath = '/learning/php-aiqfome-challenge/Public';
$method = $_SERVER['REQUEST_METHOD'];
$uri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
$route = "$method $uri";

$methods = [
    'GET',
    'PUT',
    'DELETE'
];

if (in_array($method, $methods) && preg_match('#^/customer/(\d+)$#', $uri, $matches)) {
    $id = (int) $matches[1];
    $route = $method . ' /customer/{id}';
}

$middleware = new AuthMiddleware();

switch ($route) {
    case 'POST /auth/login':
        $controller = $container->get(AuthController::class);
        $controller->login();
        break;
    case 'POST /customer':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->create();
        break;
    case 'GET /customer/{id}':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->getById($id);
        break;
    case 'GET /customers':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->getAll();
        break;
    case 'PUT /customer/{id}':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->update($id);
        break;
    case 'DELETE /customer/{id}':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->delete($id);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada']);
        break;
}
