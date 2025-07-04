<?php

namespace Domain\Enums\Commons;

class ValidationHelper
{
    /*
    * validate name using the standard rules
    * @param string $name
    * @return array
    */

    public static function validateName(string $name): array
    {
        $errors = [];

        if (empty($name)) {
            $errors[] = ValidationMessages::NAME_REQUIRED->value;
            return $errors;
        }

        return $errors;
    }

    /*
    * validate email using the standard rules
    * @param string $email
    * @return array
    */

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

    /*
    * validate product id using the standard rules
    * @param string $productId
    * @return array
    */

    public static function validateProductId(string $productId): array
    {
        $errors = [];

        if (empty($productId)) {
            $errors[] = ValidationMessages::PRODUCT_ID_REQUIRED->value;
        }

        return $errors;
    }

    /*
    * validate customer id using the standard rules
    * @param string $customerId
    * @return array
    */

    public static function validateCustomerId(string $customerId): array
    {
        $errors = [];

        if (empty($customerId)) {
            $errors[] = ValidationMessages::CUSTOMER_ID_REQUIRED->value;
        }

        return $errors;
    }

    /*
    * validate title using the standard rules
    * @param string $title
    * @return array
    */

    public static function validateTitle(string $title): array
    {
        $errors = [];

        if (empty($title)) {
            $errors[] = ValidationMessages::TITLE_REQUIRED->value;
        }

        return $errors;
    }

    /*
    * validate price using the standard rules
    * @param float $price
    * @return array
    */

    public static function validatePrice(float $price): array
    {
        $errors = [];

        if (empty($price)) {
            $errors[] = ValidationMessages::PRICE_REQUIRED->value;
        }

        return $errors;
    }
}
