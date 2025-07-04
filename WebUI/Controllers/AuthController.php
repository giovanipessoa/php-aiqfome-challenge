<?php

namespace WebUI\Controllers;

use Application\Services\AuthService;
use OpenApi\Annotations as OA;

class AuthController
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * @OA\Post(
     *     path="/v1/auth/login",
     *     summary="Login",
     *     tags={"Auth"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"email", "password"},
     *             @OA\Property(property="email", type="string", format="email", example="admin@aiqfome.com"),
     *             @OA\Property(property="password", type="string", format="password", example="aiqfome")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login realizado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="token", type="string", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJFUzI1NiJ9...")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Credenciais inválidas",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="E-mail ou senha inválidos")
     *         )
     *     )
     * )
     */

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
