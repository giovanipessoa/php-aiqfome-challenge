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

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
