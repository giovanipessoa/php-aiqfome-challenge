<?php

namespace WebUI\Controllers;

use Application\UseCases\ProductUseCase;
use OpenApi\Annotations as OA;

class ProductController
{
    private $productUseCase;

    public function __construct(ProductUseCase $productUseCase)
    {
        $this->productUseCase = $productUseCase;
    }

    /**
     * @OA\Get(
     *     path="/v1/favorite-product/{id}",
     *     summary="Get a single favorite product",
     *     tags={"Favorites"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto favoritado encontrado",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="title", type="string", example="Fjallraven - Foldsack No. 1 Backpack, Fits 15 Laptops"),
     *                 @OA\Property(property="image", type="string", example="https://fakestoreapi.com/img/81fPKd-2AYL._AC_SL1500_.jpg"),
     *                 @OA\Property(property="price", type="number", format="float", example=109.95),
     *                 @OA\Property(property="review", type="boolean", example=false),
     *                 @OA\Property(property="product_id", type="integer", example=1),
     *                 @OA\Property(property="customer_id", type="integer", example=1)
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Produto não encontrado",
     *         @OA\JsonContent(
     *             @OA\Property(property="error", type="string", example="Produto não encontrado")
     *         )
     *     )
     * )
     */

    public function getByCustomerId(int $customerId)
    {
        $products = $this->productUseCase->getByCustomerId($customerId);

        if (!$products) {
            http_response_code(404);
            echo json_encode(['error' => 'Produto não encontrado']);
            return;
        }

        http_response_code(200);
        echo json_encode($products);
    }
}
