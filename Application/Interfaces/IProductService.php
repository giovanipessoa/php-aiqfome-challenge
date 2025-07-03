<?php

namespace Application\Interfaces;

interface IProductService
{
    public function exists(int $productId): bool;
}
