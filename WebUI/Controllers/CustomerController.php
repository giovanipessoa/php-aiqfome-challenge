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

    public function create()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            $name = $data['name'] ?? null;
            $email = $data['email'] ?? null;

            if (empty($name) || empty($email)) {
                http_response_code(422);
                echo json_encode(['error' => 'Nome e e-mail são obrigatórios']);
                return;
            }

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
}
