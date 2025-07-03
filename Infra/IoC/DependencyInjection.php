<?php

use Infra\Data\Interfaces\Database\IDatabase;
use Infra\Data\Context\AppDataBaseContext;
use Infra\Auth\Service;
use WebUI\Controllers\AuthController;
use Application\Services\AuthService;

// customers
use Application\Interfaces\ICustomerRepository;
use Infra\Data\Repositories\CustomerRepository;

return [
    IDatabase::class => \DI\create(AppDataBaseContext::class),
    Service::class => \DI\create(Service::class),
    AuthController::class => \DI\create(AuthController::class)
        ->constructor(\DI\get(AuthService::class)),

    ICustomerRepository::class => \DI\create(CustomerRepository::class)
        ->constructor(\DI\get(IDatabase::class)),
];
