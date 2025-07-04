<?php

namespace WebUI\Controllers;

use Application\UseCases\FavoriteProductUseCase;
use Domain\Entities\FavoriteProduct;
use OpenApi\Annotations as OA;

class FavoriteProductController
{
    private $favoriteProductUseCase;

    public function __construct(FavoriteProductUseCase $favoriteProductUseCase)
    {
        $this->favoriteProductUseCase = $favoriteProductUseCase;
    }

    /**
     * @OA\Post(
     *     path="/v1/favorite-product",
     *     summary="Add a new favorite product",
     *     tags={"Favorites"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"product_id", "customer_id"},
     *             @OA\Property(property="product_id", type="integer", example=1),
     *             @OA\Property(property="customer_id", type="integer", example=1)
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produto favoritado com sucesso",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Produto favoritado com sucesso")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Produto já está nos favoritos",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Produto já está nos favoritos.")
     *         )
     *     )
     * )
     */

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
