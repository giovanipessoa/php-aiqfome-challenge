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

    public function exists(int $productId, int $customerId): bool
    {
        return $this->interface->exists($productId, $customerId);
    }

    public function getByCustomerId(string $customerId): array
    {
        return $this->interface->getByCustomerId($customerId);
    }

    public function delete(string $id): void
    {
        $this->interface->delete($id);
    }
}
