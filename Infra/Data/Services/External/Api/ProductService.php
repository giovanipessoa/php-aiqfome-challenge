<?php

namespace Infra\Data\Services\External\Api;

use Application\Interfaces\IProductService;

class ProductService implements IProductService
{
    public function exists(int $productId): bool
    {
        $response = file_get_contents('https://fakestoreapi.com/products');

        if ($response === false) {
            return false;
        }

        $data = json_decode($response, true);

        return isset($data['id']) && $data['id'] == $productId;
    }
}
