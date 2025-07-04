<?php

namespace Application\UseCases;

use Application\Interfaces\IFavoriteProductRepository;
use Application\Interfaces\IProductService;
use Application\Interfaces\IProductRepository;
use Domain\Entities\FavoriteProduct;
use Domain\Entities\Product;
use Domain\Enums\Commons\ValidationMessages;

class FavoriteProductUseCase
{
    private IFavoriteProductRepository $iFavoriteProductRepository;
    private IProductService $iProductService;
    private IProductRepository $iProductRepository;

    public function __construct(
        IFavoriteProductRepository $favoriteProductRepository,
        IProductService $productService,
        IProductRepository $productRepository
    ) {
        $this->iFavoriteProductRepository = $favoriteProductRepository;
        $this->iProductService = $productService;
        $this->iProductRepository = $productRepository;
    }

    /*
    * create favorite product
    * @param FavoriteProduct $favoriteProduct
    * @return void
    */

    public function create(FavoriteProduct $favoriteProduct): void
    {
        $productData = $this->iProductService->exists($favoriteProduct->getProductId());

        if (!$productData) {
            throw new \Exception('Produto não encontrado.');
        }

        $apiProduct = new Product(
            $productData['id'],
            $productData['title'],
            $productData['image'],
            (float) $productData['price'],
            false
        );

        $existingProduct = $this->iProductRepository->getById($apiProduct->getId());

        if ($existingProduct) {
            if (
                $existingProduct->getTitle() !== $apiProduct->getTitle() ||
                $existingProduct->getImage() !== $apiProduct->getImage() ||
                $existingProduct->getPrice() !== $apiProduct->getPrice()
            ) {
                $apiProduct->setReview(true);
                $this->iProductRepository->update($apiProduct);
            }
        } else {
            $this->iProductRepository->create($apiProduct);
        }

        if ($this->iFavoriteProductRepository->exists($favoriteProduct->getProductId(), $favoriteProduct->getCustomerId())) {
            throw new \Exception(ValidationMessages::PRODUCT_ALREADY_IN_FAVORITES->value);
        }

        $this->iFavoriteProductRepository->create($favoriteProduct);
    }


    /*
    * check if favorite product exists
    * @param int $productId
    * @param int $customerId
    * @return bool
    */

    public function exists(int $productId, int $customerId): bool
    {
        return $this->iFavoriteProductRepository->exists($productId, $customerId);
    }

    /*
    * get favorite products by customer id
    * @param string $customerId
    * @return array
    */

    public function getByCustomerId(string $customerId): array
    {
        return $this->iFavoriteProductRepository->getByCustomerId($customerId);
    }

    /*
    * delete favorite product
    * @param string $id
    * @return void
    */

    public function delete(string $id): void
    {
        $this->iFavoriteProductRepository->delete($id);
    }
}
