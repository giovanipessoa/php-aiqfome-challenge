<?php

namespace WebUI\Controllers;

use Application\UseCases\FavoriteProductUseCase;
use Domain\Entities\FavoriteProduct;

class FavoriteProductController
{
    private $favoriteProductUseCase;

    public function __construct(FavoriteProductUseCase $favoriteProductUseCase)
    {
        $this->favoriteProductUseCase = $favoriteProductUseCase;
    }

    public function create()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            $productId = !isset($data['product_id']) || empty($data['product_id']) ? 0 : $data['product_id'];
            $customerId = !isset($data['customer_id']) || empty($data['customer_id']) ? 0 : $data['customer_id'];

            $this->favoriteProductUseCase->create(new FavoriteProduct($productId, $customerId));

            http_response_code(201);
            echo json_encode(['message' => 'Produto favoritado com sucesso']);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
