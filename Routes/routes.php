<?php

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

$middleware = new AuthMiddleware();

if (str_starts_with($uri, '/v1/')) {
    require_once __DIR__ . '/v1/auth.php';
    require_once __DIR__ . '/v1/customer.php';
    require_once __DIR__ . '/v1/favorite-product.php';
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Versão da API não suportada']);
}
