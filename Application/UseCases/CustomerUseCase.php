<?php

namespace Application\UseCases;

use Application\Interfaces\ICustomerRepository;
use Domain\Entities\Customer;
use Domain\Enums\Commons\ValidationMessages;

class CustomerUseCase
{
    private ICustomerRepository $interface;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->interface = $customerRepository;
    }

    /*
    * create customer
    * @param Customer $customer
    * @return Customer
    */

    public function create(Customer $customer): Customer
    {
        if ($this->interface->getByEmail($customer->email)) {
            throw new \Exception(ValidationMessages::EMAIL_ALREADY_EXISTS->value);
        }

        $this->interface->create($customer);
        return $customer;
    }

    /*
    * get customer by id
    * @param string $id
    * @return Customer
    */

    public function getById(string $id): Customer
    {
        return $this->interface->getById($id);
    }

    /*
    * get customer by email
    * @param string $email
    * @return Customer
    */

    public function getByEmail(string $email): Customer
    {
        return $this->interface->getByEmail($email);
    }

    /*
    * get all customers
    * @return array
    */

    public function getAll(): array
    {
        return $this->interface->getAll();
    }

    /*
    * update customer
    * @param Customer $customer
    * @return void
    */

    public function update(Customer $customer): void
    {
        $this->interface->update($customer);
    }

    /*
    * delete customer
    * @param string $id
    * @return void
    */

    public function delete(string $id): void
    {
        $this->interface->delete($id);
    }
}
