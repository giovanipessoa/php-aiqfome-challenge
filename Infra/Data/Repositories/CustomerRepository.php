<?php

namespace Infra\Data\Repositories;

use Application\Interfaces\ICustomerRepository;
use Infra\Data\Interfaces\Database\IDatabase;
use Domain\Entities\Customer;
use PDO;

class CustomerRepository implements ICustomerRepository
{
    private IDatabase $database;

    public function __construct(IDatabase $database)
    {
        $this->database = $database;
    }

    /*
    * create customer
    * @param Customer $customer
    * @return Customer
    */

    public function create(Customer $customer): Customer
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO customers (name, email) VALUES (?, ?)");
        $stmt->execute([$customer->getName(), $customer->getEmail()]);

        // set id to the customer after create
        $customer->setId($this->database->getConnection()->lastInsertId());
        return $customer;
    }

    /*
    * get customer by id
    * @param string $id
    * @return Customer
    */

    public function getById(string $id): ?Customer
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM customers WHERE id = ?");
        $stmt->execute([$id]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        return $customer ? new Customer($customer['id'], $customer['name'], $customer['email']) : null;
    }

    /*
    * get customer by email
    * @param string $email
    * @return Customer
    */

    public function getByEmail(string $email): ?Customer
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM customers WHERE email = ?");
        $stmt->execute([$email]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        return $customer ? new Customer($customer['id'], $customer['name'], $customer['email']) : null;
    }

    /*
    * get all customers
    * @return array
    */

    public function getAll(): array
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM customers");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*
    * update customer
    * @param Customer $customer
    * @return void
    */

    public function update(Customer $customer): void
    {
        $stmt = $this->database->getConnection()->prepare("UPDATE customers SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$customer->getName(), $customer->getEmail(), $customer->getId()]);
    }

    /*
    * delete customer
    * @param string $id
    * @return void
    */

    public function delete(string $id): void
    {
        $stmt = $this->database->getConnection()->prepare("DELETE FROM customers WHERE id = ?");
        $stmt->execute([$id]);
    }
}
