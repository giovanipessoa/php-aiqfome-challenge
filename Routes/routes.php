<?php

use WebUI\Middlewares\AuthMiddleware;

$requestUri = $_SERVER['REQUEST_URI'];
$pathUntilPublic = substr($requestUri, 0, strpos($requestUri, '/Public') + strlen('/Public'));
$uri = str_replace($pathUntilPublic, '', $requestUri);
$method = $_SERVER['REQUEST_METHOD'];
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
