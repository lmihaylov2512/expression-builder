<?php

namespace ExpressionBuilder\Expression;

/**
 * Class Expression
 * @package ExpressionBuilder\Expression
 *
 * The class represent given expression in object-oriented style.
 */
class Expression implements ExpressionInterface
{
    /**
     * @var PropertyInterface[]
     */
    protected $properties = [];
    /**
     * @var OperatorInterface[]
     */
    protected $operators = [];
    /**
     * @var ValueInterface[]
     */
    protected $values = [];

    /**
     * @var string
     * @todo supports all kinds of logical operators
     */
    protected $logicalOperator = 'AND';

    /**
     * Appends a new property.
     *
     * @param PropertyInterface $property
     * @return $this
     */
    public function addProperty(PropertyInterface $property)
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * Appends a new operator.
     *
     * @param OperatorInterface $operator
     * @return $this
     */
    public function addOperator(OperatorInterface $operator)
    {
        $this->operators[] = $operator;

        return $this;
    }

    /**
     * Appends a new value.
     *
     * @param ValueInterface $value
     * @return $this
     */
    public function addValue(ValueInterface $value)
    {
        $this->values[] = $value;

        return $this;
    }

    /**
     * Returns all properties.
     *
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * Returns all operators.
     *
     * @return array
     */
    public function getOperators(): array
    {
        return $this->operators;
    }

    /**
     * Returns all values.
     *
     * @return array
     */
    public function getValues(): array
    {
        return $this->values;
    }

    /**
     * Returns the logical operator.
     *
     * @return string
     */
    public function getLogicalOperator(): string
    {
        return $this->logicalOperator;
    }
}
