<?php

use Infra\Data\Interfaces\Database\IDatabase;
use Infra\Data\Context\AppDataBaseContext;
use Infra\Auth\Service;
use WebUI\Controllers\AuthController;
use Application\Services\AuthService;

// customer
use Application\Interfaces\ICustomerRepository;
use Infra\Data\Repositories\CustomerRepository;
use Application\UseCases\CustomerUseCase;

// favorite product
use Application\Interfaces\IFavoriteProductRepository;
use Infra\Data\Repositories\FavoriteProductRepository;
use Application\Interfaces\IProductService;
use Infra\Data\Services\External\Api\ProductService;
use Application\UseCases\FavoriteProductUseCase;
use WebUI\Controllers\FavoriteProductController;

// product
use Application\Interfaces\IProductRepository;
use Infra\Data\Repositories\ProductRepository;
use Application\UseCases\ProductUseCase;

/*
* dependency injection
* @return array
*/

return [
    IDatabase::class => \DI\create(AppDataBaseContext::class),
    Service::class => \DI\create(Service::class),
    AuthController::class => \DI\create(AuthController::class)
        ->constructor(\DI\get(AuthService::class)),

    ICustomerRepository::class => \DI\create(CustomerRepository::class)
        ->constructor(\DI\get(IDatabase::class)),

    CustomerUseCase::class => \DI\create(CustomerUseCase::class)
        ->constructor(\DI\get(ICustomerRepository::class)),

    IFavoriteProductRepository::class => \DI\create(FavoriteProductRepository::class)
        ->constructor(\DI\get(IDatabase::class)),

    IProductService::class => \DI\create(ProductService::class),

    FavoriteProductUseCase::class => \DI\create(FavoriteProductUseCase::class)
        ->constructor(\DI\get(IFavoriteProductRepository::class), \DI\get(IProductService::class), \DI\get(IProductRepository::class)),

    FavoriteProductController::class => \DI\create(FavoriteProductController::class)
        ->constructor(\DI\get(FavoriteProductUseCase::class)),

    IProductRepository::class => \DI\create(ProductRepository::class)
        ->constructor(\DI\get(IDatabase::class)),

    ProductUseCase::class => \DI\create(ProductUseCase::class)
        ->constructor(\DI\get(IProductRepository::class)),
];
