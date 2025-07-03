<?php

namespace Application\Interfaces;

use Domain\Entities\FavoriteProduct;

interface IFavoriteProductRepository
{
    public function create(FavoriteProduct $favoriteProduct): void;
    public function exists(int $productId, int $customerId): bool;
    public function getByCustomerId(string $customerId): array;
    public function delete(string $id): void;
}
