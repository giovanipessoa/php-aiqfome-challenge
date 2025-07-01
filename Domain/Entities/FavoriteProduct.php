<?php

namespace Domain\Entities;

use Domain\Enums\Commons\ValidationHelper;
use Domain\Enums\Commons\ValidationMessages;

class FavoriteProduct
{
    public function __construct(
        public string $productId,
        public string $customerId,
    ) {
        if (ValidationHelper::validateProductId($this->productId)) {
            throw new \Exception(implode(', ', ValidationMessages::getFavoriteProductMessages()));
        }

        if (ValidationHelper::validateCustomerId($this->customerId)) {
            throw new \Exception(implode(', ', ValidationMessages::getFavoriteProductMessages()));
        }
    }
}
