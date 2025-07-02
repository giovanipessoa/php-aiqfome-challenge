<?php

namespace Application\UseCases\Customer;

use Application\Interfaces\Customer\ICustomerRepository;
use Domain\Entities\Customer;
use Domain\Enums\Commons\ValidationMessages;

class CustomerUseCase
{
    private ICustomerRepository $interface;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->interface = $customerRepository;
    }

    public function create(Customer $customer): Customer
    {
        if ($this->interface->getByEmail($customer->email)) {
            throw new \Exception(ValidationMessages::EMAIL_ALREADY_EXISTS->value);
        }

        $this->interface->create($customer);
        return $customer;
    }

    public function getById(string $id): Customer
    {
        return $this->interface->getById($id);
    }

    public function getByEmail(string $email): Customer
    {
        return $this->interface->getByEmail($email);
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
