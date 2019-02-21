<?php

namespace ExpressionBuilder\Validators;

/**
 * Interface ValidationInterface
 * @package ExpressionBuilder\Validators
 */
interface ValidationInterface
{
    public static function validate($value): bool;
}
