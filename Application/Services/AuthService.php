<?php

namespace Application\Services;

use Infra\Auth\Service;

class AuthService
{
    public function __construct(private Service $service) {}

    public function auth(string $email, string $password): string
    {
        $user = [
            'id' => 1,
            'email' => 'admin@aiqfome.com',
            'password' => password_hash('aiqfome', PASSWORD_ARGON2ID)
        ];

        if ($email !== $user['email'] || !password_verify($password, $user['password'])) {
            throw new \Exception('E-mail ou senha inválidos');
        }

        $payload = [
            'sub' => (string) $user['id'],
            'iss' => 'aiqfome-api',
            'aud' => 'aiqfome-web',
            'iat' => time(),
            'exp' => time() + 3600,
            'nbf' => time()
        ];

        return $this->service->generateJWT($payload);
    }
}
