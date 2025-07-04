<?php

namespace Application\UseCases;

use Application\Interfaces\ICustomerRepository;
use Domain\Entities\Customer;
use Domain\Enums\Commons\ValidationMessages;

class CustomerUseCase
{
    private ICustomerRepository $iCustomerRepository;

    public function __construct(ICustomerRepository $customerRepository)
    {
        $this->iCustomerRepository = $customerRepository;
    }

    /*
    * create customer
    * @param Customer $customer
    * @return Customer
    */

    public function create(Customer $customer): Customer
    {
        if ($this->iCustomerRepository->getByEmail($customer->email)) {
            throw new \Exception(ValidationMessages::EMAIL_ALREADY_EXISTS->value);
        }

        $this->iCustomerRepository->create($customer);
        return $customer;
    }

    /*
    * get customer by id
    * @param string $id
    * @return Customer
    */

    public function getById(string $id): ?Customer
    {
        return $this->iCustomerRepository->getById($id);
    }

    /*
    * get customer by email
    * @param string $email
    * @return Customer
    */

    public function getByEmail(string $email): ?Customer
    {
        return $this->iCustomerRepository->getByEmail($email);
    }

    /*
    * get all customers
    * @return array
    */

    public function getAll(): array
    {
        return $this->iCustomerRepository->getAll();
    }

    /*
    * update customer
    * @param Customer $customer
    * @return void
    */

    public function update(Customer $customer): void
    {
        $this->iCustomerRepository->update($customer);
    }

    /*
    * delete customer
    * @param string $id
    * @return void
    */

    public function delete(string $id): void
    {
        $this->iCustomerRepository->delete($id);
    }
}
