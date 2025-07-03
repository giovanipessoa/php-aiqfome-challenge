<?php

namespace Application\UseCases;

use Application\Interfaces\IFavoriteProductRepository;
use Application\Interfaces\IProductService;
use Domain\Entities\FavoriteProduct;

class FavoriteProductUseCase
{
    private IFavoriteProductRepository $interface;
    private IProductService $productService;

    public function __construct(
        IFavoriteProductRepository $favoriteProductRepository,
        IProductService $productService
    ) {
        $this->interface = $favoriteProductRepository;
        $this->productService = $productService;
    }

    /*
    * create favorite product
    * @param FavoriteProduct $favoriteProduct
    * @return void
    */

    public function create(FavoriteProduct $favoriteProduct): void
    {
        if (!$this->productService->exists($favoriteProduct->getProductId())) {
            throw new \Exception('Produto não encontrado.');
        }

        if ($this->interface->exists($favoriteProduct->getProductId(), $favoriteProduct->getCustomerId())) {
            throw new \Exception('Produto já está nos favoritos.');
        }

        $this->interface->create($favoriteProduct);
    }

    /*
    * check if favorite product exists
    * @param int $productId
    * @param int $customerId
    * @return bool
    */

    public function exists(int $productId, int $customerId): bool
    {
        return $this->interface->exists($productId, $customerId);
    }

    /*
    * get favorite products by customer id
    * @param string $customerId
    * @return array
    */

    public function getByCustomerId(string $customerId): array
    {
        return $this->interface->getByCustomerId($customerId);
    }

    /*
    * delete favorite product
    * @param string $id
    * @return void
    */

    public function delete(string $id): void
    {
        $this->interface->delete($id);
    }
}
