<?php

namespace Domain\Enums\Commons;

enum ValidationRules: string
{
    case EMAIL_REGEX = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
    case PASSWORD_REGEX = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/';

    // Check if a value matches the regex pattern
    public function matches(string $value): bool
    {
        if (!str_starts_with($this->value, '/')) {
            return false;
        }

        return preg_match($this->value, $value) === 1;
    }
}
