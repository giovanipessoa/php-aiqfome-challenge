<?php

namespace Application\Interfaces;

use Domain\Entities\Product;

interface IProductRepository
{
    public function create(Product $product): Product;
    public function getById(int $id): Product;
    public function getByCustomerId(int $customerId): array;
    public function getByTitle(string $title): array;
    public function getAll(): array;
    public function update(Product $product): void;
    public function delete(int $id): void;
}
