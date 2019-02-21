<?php

namespace ExpressionBuilder\Validators;

/**
 * Class StringValidation
 * @package ExpressionBuilder\Validators
 *
 * Validation of string data type.
 */
class StringValidation implements ValidationInterface
{
    /**
     * Performs string data type validation.
     *
     * @param $value
     * @return bool
     */
    public static function validate($value): bool
    {
        return (bool) preg_match('/^[\'\"]{1}.+[\'\"]{1}$/', $value);
    }
}
