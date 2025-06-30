<?php

namespace Domain\Enums\Commons;

class ValidationHelper
{
    // Validate name using the standard rules
    public static function validateName(string $name): array
    {
        $errors = [];

        if (empty($name)) {
            $errors[] = ValidationMessages::NAME_REQUIRED->value;
            return $errors;
        }

        return $errors;
    }

    // Validate email using the standard rules
    public static function validateEmail(string $email): array
    {
        $errors = [];

        if (empty($email)) {
            $errors[] = ValidationMessages::EMAIL_REQUIRED->value;
            return $errors;
        }

        if (!ValidationRules::EMAIL_REGEX->matches($email)) {
            $errors[] = ValidationMessages::EMAIL_INVALID_FORMAT->value;
        }

        return $errors;
    }
}
