<?php

namespace Application\Interfaces;

use Domain\Entities\Customer;

interface ICustomerRepository
{
    public function create(Customer $customer): Customer;
    public function getById(string $id): Customer;
    public function getByEmail(string $email): ?Customer;
    public function getAll(): array;
    public function update(Customer $customer): void;
    public function delete(string $id): void;
}
