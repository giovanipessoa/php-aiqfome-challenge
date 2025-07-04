<?php

namespace Domain\Enums\Commons;

enum ValidationMessages: string
{
    // customers and favorite products
    case NAME_REQUIRED = 'O nome é obrigatório';
    case EMAIL_REQUIRED = 'O e-mail é obrigatório';
    case EMAIL_INVALID_FORMAT = 'O formato do e-mail é inválido';
    case EMAIL_ALREADY_EXISTS = 'Este e-mail já está cadastrado';
    case PASSWORD_REQUIRED = 'A senha é obrigatória';
    case PASSWORD_WEAK = 'A senha deve conter pelo menos uma letra maiúscula, uma minúscula e um número';
    case PRODUCT_ID_REQUIRED = 'O produto é obrigatório';
    case CUSTOMER_ID_REQUIRED = 'O cliente é obrigatório';
    case PRODUCT_NOT_FOUND = 'Produto não encontrado';
    case PRODUCT_ALREADY_IN_FAVORITES = 'Produto já está nos favoritos';
    case TITLE_REQUIRED = 'O título é obrigatório';
    case PRICE_REQUIRED = 'O preço é obrigatório';
    case PRODUCT_ALREADY_EXISTS = 'Este produto já existe';

    public static function getNameMessages(): array
    {
        return [
            self::NAME_REQUIRED
        ];
    }

    public static function getEmailMessages(): array
    {
        return [
            self::EMAIL_REQUIRED,
            self::EMAIL_INVALID_FORMAT
        ];
    }

    public static function getEmailAlreadyExistsMessages(): array
    {
        return [
            self::EMAIL_ALREADY_EXISTS
        ];
    }

    public static function getCustomerIdRequiredMessages(): array
    {
        return [
            self::CUSTOMER_ID_REQUIRED
        ];
    }

    public static function getProductIdRequiredMessages(): array
    {
        return [
            self::PRODUCT_ID_REQUIRED
        ];
    }

    public static function getProductNotFoundMessages(): array
    {
        return [
            self::PRODUCT_NOT_FOUND
        ];
    }

    public static function getProductAlreadyInFavoritesMessages(): array
    {
        return [
            self::PRODUCT_ALREADY_IN_FAVORITES
        ];
    }

    public static function getTitleRequiredMessages(): array
    {
        return [
            self::TITLE_REQUIRED
        ];
    }

    public static function getPriceRequiredMessages(): array
    {
        return [
            self::PRICE_REQUIRED
        ];
    }
}
