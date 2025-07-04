<?php

namespace WebUI\Controllers;

use Application\UseCases\ProductUseCase;

class ProductController
{
    private $productUseCase;

    public function __construct(ProductUseCase $productUseCase)
    {
        $this->productUseCase = $productUseCase;
    }

    /*
    * get products by customer id
    * @param int $customerId
    * @return void
    */

    public function getByCustomerId(int $customerId)
    {
        $products = $this->productUseCase->getByCustomerId($customerId);

        http_response_code(200);
        echo json_encode($products);
    }
}
