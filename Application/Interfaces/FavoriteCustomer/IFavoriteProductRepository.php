<?php

namespace Application\Interfaces\FavoriteCustomer;

use Domain\Entities\FavoriteProduct;

interface IFavoriteProductRepository
{
    public function create(FavoriteProduct $favoriteProduct): void;
    public function getById(string $id): FavoriteProduct;
    public function getByCustomerId(string $customerId): array;
    public function delete(string $id): void;
}
