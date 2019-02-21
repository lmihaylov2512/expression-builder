<?php

namespace ExpressionBuilder;

use ExpressionBuilder\{
    Expression\ExpressionInterface, Expression\OperatorInterface, Expression\PropertyInterface, Expression\ValueInterface
};

/**
 * Class Builder
 * @package ExpressionBuilder
 *
 * Builds expression string of specific expression object.
 */
class Builder
{
    /**
     * @var bool whether has external brackets
     */
    protected $hasBrackets;

    /**
     * Builder constructor.
     * @param bool $hasBrackets
     */
    public function __construct(bool $hasBrackets = true)
    {
        $this->hasBrackets = $hasBrackets;
    }

    /**
     * Returns expression string.
     *
     * @param ExpressionInterface $expression
     * @return string
     */
    public function build(ExpressionInterface $expression): string
    {
        // fetching expression data
        $properties = $expression->getProperties();
        $operators = $expression->getOperators();
        $values = $expression->getValues();
        $logicalOperator = $expression->getLogicalOperator();

        // performing all joins
        $statements = $this->joinComparisonOperator($properties, $operators, $values);
        $expression = $this->joinLogicalOperator($statements, $logicalOperator);

        return $this->hasBrackets ? "({$expression})" : $expression;
    }

    /**
     * Merges all parts into sub-expressions.
     *
     * @param PropertyInterface[] $properties
     * @param OperatorInterface[] $operators
     * @param ValueInterface[] $values
     * @return array
     */
    protected function joinComparisonOperator(array $properties, array $operators, array $values): array
    {
        $statements = [];

        for ($i = 0, $count = count($properties); $i < $count; $i++) {
            $statements[] = "{$properties[$i]->getName()}{$operators[$i]->getOperator()}{$values[$i]->getValue()}";
        }

        return $statements;
    }

    /**
     * Merges sub-expressions with logical operator.
     *
     * @param array $statements
     * @param string $logicalOperator
     * @return string
     */
    protected function joinLogicalOperator(array $statements, string $logicalOperator): string
    {
        return implode(" {$logicalOperator} ", $statements);
    }
}
