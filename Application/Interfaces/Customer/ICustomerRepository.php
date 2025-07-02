<?php

namespace Application\Interfaces\Customer;

use Domain\Entities\Customer;

interface ICustomerRepository
{
    public function create(Customer $customer): void;
    public function getById(string $id): Customer;
    public function update(Customer $customer): void;
    public function delete(string $id): void;
}
