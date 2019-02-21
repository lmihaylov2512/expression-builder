<?php

namespace ExpressionBuilder\Validators;

/**
 * Class IntegerValidation
 * @package ExpressionBuilder\Validators
 *
 * Validation of integer data type.
 */
class IntegerValidation implements ValidationInterface
{
    /**
     * Performs integer data type validation.
     *
     * @param $value
     * @return bool
     */
    public static function validate($value): bool
    {
        return (bool) preg_match('/^\d+$/', $value);
    }
}
