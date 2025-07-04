<?php

use WebUI\Controllers\AuthController;
use WebUI\Controllers\CustomerController;
use WebUI\Controllers\FavoriteProductController;
use WebUI\Controllers\ProductController;
use WebUI\Middlewares\AuthMiddleware;

$basePath = '/learning/php-aiqfome-challenge/Public';
$method = $_SERVER['REQUEST_METHOD'];
$uri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
$route = "$method $uri";

// get methods
$methods = [
    'GET',
    'PUT',
    'DELETE'
];

// get customer from uri
if (in_array($method, $methods) && preg_match('#^/customer/(\d+)$#', $uri, $matches)) {
    $id = (int) $matches[1];
    $route = $method . ' /customer/{id}';
}

// get favorite-product from uri
if (in_array($method, $methods) && preg_match('#^/favorite-product/(\d+)$#', $uri, $matches)) {
    $id = (int) $matches[1];
    $route = $method . ' /favorite-product/{id}';
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
    case 'POST /favorite-product':
        // require auth
        $middleware->handle();

        $controller = $container->get(FavoriteProductController::class);
        $controller->create();
        break;

    case 'GET /favorite-product/{id}':
        // require auth
        $middleware->handle();

        $controller = $container->get(ProductController::class);
        $controller->getByCustomerId($id);
        break;
    default:
        http_response_code(404);
        echo json_encode(['error' => 'Rota não encontrada']);
        break;
}
