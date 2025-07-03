<?php

namespace WebUI\Middlewares;

use Infra\Auth\Service;

class AuthMiddleware
{
    public function handle(): void
    {
        $headers = getallheaders();
        $auth = $headers['Authorization'] ?? '';

        if (!str_starts_with($auth, 'Bearer ')) {
            http_response_code(401);
            echo json_encode(['error' => 'Token não fornecido.']);
            exit;
        }

        $jwt = str_replace('Bearer ', '', $auth);

        try {
            $service = new Service();
            $service->validateJWT($jwt);
        } catch (\Throwable $e) {
            http_response_code(401);
            echo json_encode(['error' => 'Token inválido ou expirado.']);
            exit;
        }
    }
}
