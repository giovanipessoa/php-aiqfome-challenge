<?php

namespace Application\UseCases;

use Application\Interfaces\IProductRepository;
use Domain\Entities\Product;
use Domain\Enums\Commons\ValidationMessages;

class ProductUseCase
{
    private IProductRepository $iProductRepository;

    public function __construct(IProductRepository $productRepository)
    {
        $this->iProductRepository = $productRepository;
    }

    /*
    * create product
    * @param Product $product
    * @return Product
    */

    public function create(Product $product): Product
    {
        if ($this->iProductRepository->getByTitle($product->title)) {
            throw new \Exception(ValidationMessages::PRODUCT_ALREADY_EXISTS->value);
        }

        $this->iProductRepository->create($product);
        return $product;
    }

    /*
    * get product by id
    * @param int $id
    * @return Product
    */

    public function getById(int $id): Product
    {
        return $this->iProductRepository->getById($id);
    }

    /*
    * get products by customer id
    * @param int $customerId
    * @return array
    */

    public function getByCustomerId(int $customerId): array
    {
        return $this->iProductRepository->getByCustomerId($customerId);
    }

    /*
    * get products by title
    * @param string $title
    * @return array
    */

    public function getByTitle(string $title): array
    {
        return $this->iProductRepository->getByTitle($title);
    }

    /*
    * get all products
    * @return array
    */

    public function getAll(): array
    {
        return $this->iProductRepository->getAll();
    }

    /*
    * update product
    * @param Product $product
    * @return void
    */

    public function update(Product $product): void
    {
        $this->iProductRepository->update($product);
    }
}
