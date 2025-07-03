<?php

namespace Infra\Auth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Service
{
    private string $privateKeyPath;
    private string $publicKeyPath;

    /*
    * generate keys
    * openssl ecparam -name prime256v1 -genkey -noout -out private.key
    * openssl ec -in private.key -pubout -out public.key
    */

    public function __construct()
    {
        $this->privateKeyPath = __DIR__ . '/Keys/private.key';
        $this->publicKeyPath = __DIR__ . '/Keys/public.key';
    }

    public function generateJWT(array $payload): string
    {
        $privateKey = file_get_contents($this->privateKeyPath);
        return JWT::encode($payload, $privateKey, 'ES256');
    }

    public function validateJWT(string $jwt): object
    {
        $publicKey = file_get_contents($this->publicKeyPath);
        return JWT::decode($jwt, new Key($publicKey, 'ES256'));
    }
}
