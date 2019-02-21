<?php

namespace ExpressionBuilder\Expression;

class Operator implements OperatorInterface
{
    /**
     * @var string expression operator
     */
    protected $operator;

    /**
     * Operator constructor.
     * @param string $operator
     */
    public function __construct(string $operator)
    {
        $this->operator = $operator;
    }

    /**
     * Returns the operator.
     *
     * @return string
     */
    public function getOperator(): string
    {
        return $this->operator;
    }
}
