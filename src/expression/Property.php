<?php

namespace ExpressionBuilder\Expression;

/**
 * Class Property
 * @package ExpressionBuilder\Expression
 */
class Property implements PropertyInterface
{
    /**
     * @var string property name
     */
    protected $name;

    /**
     * Property constructor.
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Returns the property name.
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}
