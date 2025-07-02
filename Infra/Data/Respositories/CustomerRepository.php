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

    public function create(Customer $customer): Customer
    {
        $stmt = $this->database->getConnection()->prepare("INSERT INTO customers (name, email) VALUES (?, ?)");
        $stmt->execute([$customer->getName(), $customer->getEmail()]);
        return $customer;
    }

    public function getById(string $id): Customer
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM customers WHERE id = ?");
        $stmt->execute([$id]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        return $customer;
    }

    public function getByEmail(string $email): ?Customer
    {
        $stmt = $this->database->getConnection()->prepare("SELECT * FROM customers WHERE email = ?");
        $stmt->execute([$email]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);
        return $customer;
    }

    public function update(Customer $customer): void
    {
        $stmt = $this->database->getConnection()->prepare("UPDATE customers SET name = ?, email = ? WHERE id = ?");
        $stmt->execute([$customer->getName(), $customer->getEmail(), $customer->getId()]);
    }

    public function delete(string $id): void
    {
        $stmt = $this->database->getConnection()->prepare("DELETE FROM customers WHERE id = ?");
        $stmt->execute([$id]);
    }
}
