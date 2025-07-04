<?php

namespace Infra\Data\Services\External\Api;

use Application\Interfaces\IProductService;

class ProductService implements IProductService
{
    public function exists(int $productId): array
    {
        $response = file_get_contents('https://fakestoreapi.com/products/' . $productId);

        if ($response === false) {
            return [];
        }

        $data = json_decode($response, true);

        return $data;
    }
}
