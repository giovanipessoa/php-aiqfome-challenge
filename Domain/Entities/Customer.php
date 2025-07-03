<?php

namespace Domain\Entities;

use Domain\Enums\Commons\ValidationHelper;
use Domain\Enums\Commons\ValidationMessages;

class Customer
{
    public function __construct(
        public int $id,
        public string $name,
        public string $email
    ) {
        if (ValidationHelper::validateName($this->name)) {
            throw new \Exception(implode(', ', array_map(fn($m) => $m->value, ValidationMessages::getNameMessages())));
        }

        if (ValidationHelper::validateEmail($this->email)) {
            throw new \Exception(implode(', ', array_map(fn($m) => $m->value, ValidationMessages::getEmailMessages())));
        }
    }

    /*
    * set id
    * @param int $id
    */

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /*
    * set name
    * @param string $name
    */

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /*
    * set email
    * @param string $email
    */

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /*
    * get id
    * @return int
    */

    public function getId(): string
    {
        return $this->id;
    }

    /*
    * get name
    * @return string
    */

    public function getName(): string
    {
        return $this->name;
    }

    /*
    * get email
    * @return string
    */

    public function getEmail(): string
    {
        return $this->email;
    }
}
