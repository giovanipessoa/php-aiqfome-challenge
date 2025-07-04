<?php

namespace Application\UseCases;

use Application\Interfaces\IFavoriteProductRepository;
use Application\Interfaces\IProductService;
use Domain\Entities\FavoriteProduct;

class FavoriteProductUseCase
{
    private IFavoriteProductRepository $iFavoriteProductRepository;
    private IProductService $iProductService;

    public function __construct(
        IFavoriteProductRepository $favoriteProductRepository,
        IProductService $productService
    ) {
        $this->iFavoriteProductRepository = $favoriteProductRepository;
        $this->iProductService = $productService;
    }

    /*
    * create favorite product
    * @param FavoriteProduct $favoriteProduct
    * @return void
    */

    public function create(FavoriteProduct $favoriteProduct): void
    {
        if (!$this->iProductService->exists($favoriteProduct->getProductId())) {
            throw new \Exception('Produto não encontrado.');
        }

        if ($this->iFavoriteProductRepository->exists($favoriteProduct->getProductId(), $favoriteProduct->getCustomerId())) {
            throw new \Exception('Produto já está nos favoritos.');
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
