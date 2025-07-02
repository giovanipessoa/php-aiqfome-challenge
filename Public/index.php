<?php

require_once __DIR__ . '/../vendor/autoload.php';

use WebUI\Controllers\CustomerController;

$basePath = '/learning/php-aiqfome-challenge/Public';
$requestUri = str_replace($basePath, '', $_SERVER['REQUEST_URI']);
$method = $_SERVER['REQUEST_METHOD'];

if ($requestUri == '/customer/create' && $method == 'POST') {
    (new CustomerController())->create();
} else {
    http_response_code(404);
    echo json_encode(['error' => 'Rota não encontrada']);
}
