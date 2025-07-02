<?php

// composer test:unit

namespace Tests\Unit\Customer;

use Domain\Entities\Customer;
use PHPUnit\Framework\TestCase;
use Domain\Enums\Commons\ValidationMessages;

class CustomerTest extends TestCase
{
    public function testCreateCustomerWithValidData()
    {
        $name = 'Giovani Pessoa';
        $email = 'giovanipessoa@live.com';

        $customer = new Customer(1, $name, $email);

        $this->assertInstanceOf(Customer::class, $customer);
        $this->assertEquals($name, $customer->name);
        $this->assertEquals($email, $customer->email);
    }

    public function testCreateCustomerWithEmptyName()
    {
        $name = '';
        $email = 'giovanipessoa@live.com';

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(ValidationMessages::NAME_REQUIRED->value);

        new Customer(1, $name, $email);
    }

    public function testCreateCustomerWithEmptyEmail()
    {
        $name = 'Giovani Pessoa';
        $email = '';

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(ValidationMessages::EMAIL_REQUIRED->value);

        new Customer(1, $name, $email);
    }

    public function testCreateCustomerWithInvalidEmail()
    {
        $name = 'Giovani Pessoa';
        $email = 'giovanipessoa';

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage(ValidationMessages::EMAIL_INVALID_FORMAT->value);

        new Customer(1, $name, $email);
    }
}
