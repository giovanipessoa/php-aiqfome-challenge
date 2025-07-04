<?php

// composer test:unit

namespace Tests\Unit;

use Domain\Entities\FavoriteProduct;
use PHPUnit\Framework\TestCase;
use Domain\Enums\Commons\ValidationMessages;

class FavoriteProductTest extends TestCase
{
    public function testCreateFavoriteProductWithValidData()
    {
        $customerId = 1;
        $productId = 1;

        $favoriteProduct = new FavoriteProduct($customerId, $productId);

        $this->assertInstanceOf(FavoriteProduct::class, $favoriteProduct);
        $this->assertEquals($customerId, $favoriteProduct->customerId);
        $this->assertEquals($productId, $favoriteProduct->productId);
    }

    public function testCreateFavoriteProductWithEmptyCustomerId()
    {
        $customerId = 0;
        $productId = 1;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(ValidationMessages::CUSTOMER_ID_REQUIRED->value);

        new FavoriteProduct($customerId, $productId);
    }

    public function testCreateFavoriteProductWithEmptyProductId()
    {
        $customerId = 1;
        $productId = 0;

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(ValidationMessages::PRODUCT_ID_REQUIRED->value);

        new FavoriteProduct($customerId, $productId);
    }
}
