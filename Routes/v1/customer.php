<?php

use WebUI\Controllers\CustomerController;

// get customer from uri
if (in_array($method, $methods) && preg_match('#^/v1/customer/(\d+)$#', $uri, $matches)) {
    $id = (int) $matches[1];
    $route = $method . ' /v1/customer/{id}';
}

switch ($route) {
    case 'POST /v1/customer':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->create();
        break;
    case 'GET /v1/customer/{id}':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->getById($id);
        break;
    case 'GET /v1/customers':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->getAll();
        break;
    case 'PUT /v1/customer/{id}':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->update($id);
        break;
    case 'DELETE /v1/customer/{id}':
        // require auth
        $middleware->handle();

        $controller = $container->get(CustomerController::class);
        $controller->delete($id);
        break;
}
