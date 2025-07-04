<?php

use WebUI\Controllers\FavoriteProductController;
use WebUI\Controllers\ProductController;

// get favorite-product from uri
if (in_array($method, $methods) && preg_match('#^/v1/favorite-product/(\d+)$#', $uri, $matches)) {
    $id = (int) $matches[1];
    $route = $method . ' /v1/favorite-product/{id}';
}

switch ($route) {
    case 'POST /v1/favorite-product':
        // require auth
        $middleware->handle();

        $controller = $container->get(FavoriteProductController::class);
        $controller->create();
        break;

    case 'GET /v1/favorite-product/{id}':
        // require auth
        $middleware->handle();

        $controller = $container->get(ProductController::class);
        $controller->getByCustomerId($id);
        break;
}
