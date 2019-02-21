<?php

namespace ExpressionBuilder;

use ExpressionBuilder\Exceptions\{
    InvalidOperatorException, InvalidPropertyException, InvalidValueTypeException
};

use ExpressionBuilder\Expression\{
    ExpressionInterface, Expression, Operator, Property, PropertyInterface, Value, ValueInterface
};

use ExpressionBuilder\Validators\{
    IntegerValidation, StringValidation
};

/**
 * Class Parser
 * @package ExpressionBuilder
 *
 * Parses an expression that looks similar to the SQL syntax.
 * It performs validation based on submitted data types configuration array.
 */
class Parser
{
    /**
     * @var Builder
     */
    protected $builder;
    /**
     * @var array supported properties and data types
     */
    protected $dataTypes;

    /**
     * @var string concatenated logical operators
     */
    private $_logicalOperators;
    /**
     * @var string concatenated comparison operators
     */
    private $_comparisonOperators;

    /**
     * Parser constructor.
     * @param Builder $builder
     * @param array $dataTypes
     */
    public function __construct(Builder $builder, array $dataTypes = [])
    {
        $this->builder = $builder;
        $this->dataTypes = $dataTypes;

        // additional code
        $this->init();
    }

    /**
     * Initializes additional data.
     */
    protected function init()
    {
        $this->_logicalOperators = Utils::getLogicalOperatorsString('|');
        $this->_comparisonOperators = Utils::getComparisonOperatorsString('|');
    }

    /**
     * Converts string expression to Expression object
     *
     * @param  string $expression
     * @return ExpressionInterface
     * @throws InvalidOperatorException
     * @throws InvalidPropertyException
     * @throws InvalidValueTypeException
     */
    public function parse(string $expression): ExpressionInterface
    {
        $expression = $this->sanitize($expression);
        $statements = $this->splitLogicalOperator($expression);

        $expression = new Expression;
        foreach ($statements as $statement) {
            $parts = $this->splitComparisonOperator($statement);
            if (count($parts) !== 3) {
                throw new InvalidOperatorException("Invalid operator in statement '{$statement}'");
            }

            list($property, $operator, $value) = $parts;

            $property = new Property($property);
            $operator = new Operator($operator);
            $value = new Value($value);

            if ($this->validateProperty($property) && $this->validateValue($value, $this->dataTypes[$property->getName()])) {
                $expression->addProperty($property)->addOperator($operator)->addValue($value);
            }
        }

        return $expression;
    }

    /**
     * Proxy method to Builder::build().
     *
     * @see Builder::build()
     * @param ExpressionInterface $expression
     * @return string
     */
    public function build(ExpressionInterface $expression): string
    {
        return $this->builder->build($expression);
    }

    /**
     * Performs sanitization of original expression string.
     *
     * @param string $expression
     * @return string
     */
    protected function sanitize(string $expression): string
    {
        return trim($expression, '()');
    }

    /**
     * Splits the original expression on the logical operators to sub-expressions.
     *
     * @param string $expression
     * @return array
     */
    protected function splitLogicalOperator(string $expression): array
    {
        return preg_split("/\s*{$this->_logicalOperators}\s*/i", $expression, -1, PREG_SPLIT_NO_EMPTY);
    }

    /**
     * Splits a sub-expression to its parts (property, operator and value).
     *
     * @param string $statement
     * @return array
     */
    protected function splitComparisonOperator(string $statement): array
    {
        return preg_split("/({$this->_comparisonOperators})/", $statement, -1, PREG_SPLIT_DELIM_CAPTURE | PREG_SPLIT_NO_EMPTY);
    }

    /**
     * Validates specific property according to configured data types.
     *
     * @param PropertyInterface $property
     * @return bool
     * @throws InvalidPropertyException
     */
    protected function validateProperty(PropertyInterface $property): bool
    {
        if (!array_key_exists($property->getName(), $this->dataTypes)) {
            throw new InvalidPropertyException("The property '{$property->getName()}' is not defined in data types array.");
        }

        return true;
    }

    /**
     * Validates specific property value according to its data type.
     *
     * @param ValueInterface $value
     * @param string $type
     * @return bool
     * @throws InvalidValueTypeException
     */
    protected function validateValue(ValueInterface $value, string $type): bool
    {
        $validator = null;
        switch ($type) {
            case 'integer':
                $validator = IntegerValidation::class;
                break;
            case 'string':
                $validator = StringValidation::class;
                break;
        }

        if ($validator === null) {
            return false;
        }

        if (!call_user_func([$validator, 'validate'], $value->getValue())) {
            throw new InvalidValueTypeException("Incorrect property value {$value->getValue()}. Its data type is {$type}.");
        }

        return true;
    }
}
