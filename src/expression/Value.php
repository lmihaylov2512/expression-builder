<?php

namespace ExpressionBuilder\Expression;

/**
 * Class Value
 * @package ExpressionBuilder\Expression
 */
class Value implements ValueInterface
{
    /**
     * @var string property value
     */
    protected $value;

    /**
     * Value constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Returns the value.
     *
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }
}
