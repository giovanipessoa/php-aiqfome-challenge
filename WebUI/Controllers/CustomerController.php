<?php

namespace WebUI\Controllers;

class CustomerController
{
    public function create()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        if (!isset($data['name'], $data['email'])) {
            http_response_code(422);
            echo json_encode(['error' => 'Nome e e-mail são obrigatórios']);
            return;
        }

        $customer = [
            'id' => rand(1, 1000),
            'name' => $data['name'],
            'email' => $data['email']
        ];

        http_response_code(201);
        echo json_encode($customer);
    }
}
