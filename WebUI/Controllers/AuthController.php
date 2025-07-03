<?php

namespace WebUI\Controllers;

use Application\Services\AuthService;

class AuthController
{
    public function __construct(private AuthService $authService) {}

    public function login(): void
    {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        try {
            $token = $this->authService->auth($email, $password);
            echo json_encode(['token' => $token]);
        } catch (\Throwable $e) {
            http_response_code(401);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
