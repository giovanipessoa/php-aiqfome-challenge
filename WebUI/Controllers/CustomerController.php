<?php

namespace WebUI\Controllers;

use Application\UseCases\CustomerUseCase;
use Domain\Entities\Customer;
use OpenApi\Annotations as OA;

class CustomerController
{
    private $customerUseCase;

    public function __construct(CustomerUseCase $customerUseCase)
    {
        $this->customerUseCase = $customerUseCase;
    }

    /**
     * @OA\Post(
     *     path="/v1/customer",
     *     summary="Add a new customer",
     *     tags={"Customers"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"name", "email"},
     *             @OA\Property(property="name", type="string", example="Giovani Pessoa"),
     *             @OA\Property(property="email", type="string", format="email", example="giovanipessoa@live.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Cliente criado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Giovani Pessoa"),
     *             @OA\Property(property="email", type="string", format="email", example="giovanipessoa@live.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao criar cliente",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Este e-mail já está cadastrado")
     *         )
     *     )
     * )
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

    /**
     * @OA\Get(
     *     path="/v1/customer/{id}",
     *     summary="Get a single customer",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Customer ID",
     *         @OA\Schema(type="string", example="1")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Giovani Pessoa"),
     *             @OA\Property(property="email", type="string", format="email", example="giovanipessoa@live.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Cliente não encontrado")
     *         )
     *     )
     * )
     */

    public function getById(string $id)
    {
        try {
            $customer = $this->customerUseCase->getById($id);

            if (!$customer) {
                http_response_code(404);
                echo json_encode(['error' => 'Cliente não encontrado']);
                return;
            }

            http_response_code(200);
            echo json_encode($customer);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }

    /**
     * @OA\Get(
     *     path="/v1/customers",
     *     summary="Get all customers",
     *     tags={"Customers"},
     *     @OA\Response(
     *         response=200,
     *         description="Clientes encontrados",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(
     *                 type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="name", type="string", example="Giovani Pessoa"),
     *                 @OA\Property(property="email", type="string", format="email", example="giovanipessoa@live.com")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao buscar clientes",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Clientes não encontrados")
     *         )
     *     )
     * )
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

    /**
     * @OA\Put(
     *     path="/v1/customer/{id}",
     *     summary="Update a customer",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="name", type="string", example="Giovani Pessoa"),
     *             @OA\Property(property="email", type="string", format="email", example="giovanipessoa@live.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente atualizado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="id", type="integer", example=1),
     *             @OA\Property(property="name", type="string", example="Giovani Pessoa"),
     *             @OA\Property(property="email", type="string", format="email", example="giovanipessoa@live.com")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Cliente não encontrado")
     *         )
     *     )
     * )
     */

    public function update(string $id)
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            $name = $data['name'] ?? null;
            $email = $data['email'] ?? null;

            $customer = $this->customerUseCase->getById($id);

            if (!$customer) {
                http_response_code(404);
                echo json_encode(['error' => 'Cliente não encontrado']);
                return;
            }

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

    /**
     * @OA\Delete(
     *     path="/v1/customer/{id}",
     *     summary="Delete a customer",
     *     tags={"Customers"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Customer ID",
     *         required=true,
     *         @OA\Schema(type="integer", example=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Cliente deletado com sucesso",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Cliente deletado com sucesso")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Cliente não encontrado",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="error", type="string", example="Cliente não encontrado")
     *         )
     *     )
     * )
     */

    public function delete(string $id)
    {
        try {
            $customer = $this->customerUseCase->getById($id);

            if (!$customer) {
                http_response_code(404);
                echo json_encode(['error' => 'Cliente não encontrado']);
                return;
            }

            $this->customerUseCase->delete($id);

            http_response_code(200);
            echo json_encode(['message' => 'Cliente deletado com sucesso']);
        } catch (\Exception $e) {
            http_response_code(400);
            echo json_encode(['error' => $e->getMessage()]);
        }
    }
}
