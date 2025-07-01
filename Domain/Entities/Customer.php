<?php

namespace Domain\Entities;

use Domain\Enums\Commons\ValidationHelper;
use Domain\Enums\Commons\ValidationMessages;

class Customer
{
    public function __construct(
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
}
