<?php

// composer test:application

namespace Tests\Application\UseCases\Customer;

use Application\Interfaces\Customer\ICustomerRepository;
use Application\UseCases\Customer\CustomerUseCase;
use Domain\Entities\Customer;
use Domain\Enums\Commons\ValidationMessages;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class CustomerTest extends TestCase
{
    public function testCreateCustomerWithValidData()
    {
        $repository = $this->createMock(ICustomerRepository::class);
        $useCase = new CustomerUseCase($repository);

        $customer = new Customer('Giovani Pessoa', 'giovanipessoa@live.com');

        // simulates the repository returning null when the email is not found
        $repository->expects($this->once())
            ->method('getByEmail')
            ->with($customer->getEmail())
            ->willReturn(null);

        $result = $useCase->create($customer);

        $this->assertInstanceOf(Customer::class, $result);
        $this->assertEquals($customer->getName(), $result->getName());
        $this->assertEquals($customer->getEmail(), $result->getEmail());
    }

    public function testCreateCustomerWithExistingEmail()
    {
        $repository = $this->createMock(ICustomerRepository::class);
        $useCase = new CustomerUseCase($repository);

        $customer = new Customer('Giovani Pessoa', 'giovanipessoa@live.com');

        // simulates the repository returning the customer when the email is already exists
        $repository->expects($this->once())
            ->method('getByEmail')
            ->with($customer->getEmail())
            ->willReturn($customer);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(ValidationMessages::EMAIL_ALREADY_EXISTS->value);

        $useCase->create($customer);
    }
}
