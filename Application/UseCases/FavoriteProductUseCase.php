<?php

namespace Application\UseCases;

use Application\Interfaces\IFavoriteProductRepository;
use Domain\Entities\FavoriteProduct;

class FavoriteProductUseCase
{
    private IFavoriteProductRepository $interface;

    public function __construct(IFavoriteProductRepository $favoriteProductRepository)
    {
        $this->interface = $favoriteProductRepository;
    }

    public function create(FavoriteProduct $favoriteProduct): void
    {
        $this->interface->create($favoriteProduct);
    }

    public function getById(string $id): FavoriteProduct
    {
        return $this->interface->getById($id);
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
