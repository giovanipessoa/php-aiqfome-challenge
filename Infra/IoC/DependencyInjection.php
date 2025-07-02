<?php

use Infra\Data\Interfaces\Database\IDatabase;
use Infra\Data\Context\AppDataBaseContext;

// customers
use Application\Interfaces\Customer\ICustomerRepository;
use Infra\Data\Repositories\Customer\CustomerRepository;

return [
    IDatabase::class => \DI\create(AppDataBaseContext::class),

    ICustomerRepository::class => \DI\create(CustomerRepository::class)
        ->constructor(\DI\get(IDatabase::class)),
];
