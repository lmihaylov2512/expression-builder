<?php

namespace ExpressionBuilder\Expression;

/**
 * Interface ExpressionInterface
 * @package ExpressionBuilder\Expression
 */
interface ExpressionInterface
{
    public function addProperty(PropertyInterface $property);
    public function addOperator(OperatorInterface $operator);
    public function addValue(ValueInterface $value);
}
