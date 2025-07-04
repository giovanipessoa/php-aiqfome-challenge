<?php

namespace WebUI\Controllers;

use Application\UseCases\CustomerUseCase;
use Domain\Entities\Customer;

class CustomerController
{
    private $customerUseCase;

    public function __construct(CustomerUseCase $customerUseCase)
    {
        $this->customerUseCase = $customerUseCase;
    }

    /*
    * create customer
    * @return void
    */

    public function create()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            $name = $data['name'] ?? null;
            $email = $data['email'] ?? null;

            $customer = $this->customerUseCase->create(new Customer(1, $name, $email));

            http_response_code(201);
            echo json_encode([
                'id' => $customer->getId(),
                'name' => $customer->getName(),
                'email' => $customer->getEmail()
            ]);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /*
    * get customer by id
    * @param string $id
    * @return void
    */

    public function getById(string $id)
    {
        try {
            $customer = $this->customerUseCase->getById($id);

            http_response_code(200);
            echo json_encode($customer);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /*
    * get all customers
    * @return void
    */

    public function getAll()
    {
        try {
            $customers = $this->customerUseCase->getAll();

            http_response_code(200);
            echo json_encode($customers);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /*
    * update customer
    * @param string $id
    * @return void
    */

    public function update(string $id)
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            $name = $data['name'] ?? null;
            $email = $data['email'] ?? null;

            $customer = $this->customerUseCase->getById($id);

            if ($customer->getName() !== $name && !empty($name)) {
                $customer->setName($name);
            }

            if ($customer->getEmail() !== $email && !empty($email)) {
                $customer->setEmail($email);
            }

            $this->customerUseCase->update($customer);

            http_response_code(200);
            echo json_encode($customer);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /*
    * delete customer
    * @param string $id
    * @return void
    */

    public function delete(string $id)
    {
        try {
            $this->customerUseCase->delete($id);

            http_response_code(200);
            echo json_encode(['message' => 'Cliente deletado com sucesso']);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
