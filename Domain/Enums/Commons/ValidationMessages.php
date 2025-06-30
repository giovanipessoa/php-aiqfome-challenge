<?php

namespace Domain\Enums\Commons;

enum ValidationMessages: string
{
    // Customer validation messages
    case NAME_REQUIRED = 'O nome é obrigatório';
    case EMAIL_REQUIRED = 'O e-mail é obrigatório';
    case EMAIL_INVALID_FORMAT = 'O formato do e-mail é inválido';
    case EMAIL_ALREADY_EXISTS = 'Este e-mail já está cadastrado';
    case PASSWORD_REQUIRED = 'A senha é obrigatória';
    case PASSWORD_WEAK = 'A senha deve conter pelo menos uma letra maiúscula, uma minúscula e um número';

        // Favorite product validation messages
    case PRODUCT_ID_REQUIRED = 'O produto é obrigatório';
    case CUSTOMER_ID_REQUIRED = 'O cliente é obrigatório';

    // Get all name validation messages
    public static function getNameMessages(): array
    {
        return [
            self::NAME_REQUIRED
        ];
    }

    // Get all email validation messages
    public static function getEmailMessages(): array
    {
        return [
            self::EMAIL_REQUIRED,
            self::EMAIL_INVALID_FORMAT
        ];
    }

    // Get all email already exists validation messages
    public static function getEmailAlreadyExistsMessages(): array
    {
        return [
            self::EMAIL_ALREADY_EXISTS
        ];
    }

    // Get all favorite product validation messages
    public static function getFavoriteProductMessages(): array
    {
        return [
            self::PRODUCT_ID_REQUIRED,
            self::CUSTOMER_ID_REQUIRED
        ];
    }
}
