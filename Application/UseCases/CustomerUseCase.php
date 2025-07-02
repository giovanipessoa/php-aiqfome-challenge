<?php

namespace Application\UseCases;

use Application\Interfaces\ICustomerRepository;
use Domain\Entities\Customer;

class CustomerUseCase
{
    private ICustomerRepository $interface;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->interface = $customerRepository;
    }

    public function create(Customer $customer): void
    {
        $this->interface->create($customer);
    }

    public function getById(string $id): Customer
    {
        return $this->interface->getById($id);
    }

    public function update(Customer $customer): void
    {
        $this->interface->update($customer);
    }

    public function delete(string $id): void
    {
        $this->interface->delete($id);
    }
}
