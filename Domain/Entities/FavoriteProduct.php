<?php

namespace Domain\Entities;

use Domain\Enums\Commons\ValidationHelper;
use Domain\Enums\Commons\ValidationMessages;

class FavoriteProduct
{
    public function __construct(
        public int $productId,
        public int $customerId,
    ) {
        if (ValidationHelper::validateProductId($this->productId)) {
            throw new \Exception(implode(', ', array_map(fn($m) => $m->value, ValidationMessages::getProductIdRequiredMessages())));
        }

        if (ValidationHelper::validateCustomerId($this->customerId)) {
            throw new \Exception(implode(', ', array_map(fn($m) => $m->value, ValidationMessages::getCustomerIdRequiredMessages())));
        }
    }

    /*
    * get product id
    * @return int
    */

    public function getProductId(): int
    {
        return $this->productId;
    }

    /*
    * get customer id
    * @return int
    */

    public function getCustomerId(): int
    {
        return $this->customerId;
    }
}
