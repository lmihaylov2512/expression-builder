<?php

namespace ExpressionBuilder;

/**
 * Class Utils
 * @package ExpressionBuilder
 *
 * Utility helper static methods.
 */
class Utils
{
    /**
     * @var array allowed comparison operators
     * WARNING: Don't change the operators list order, because it is used in regular expression context.
     */
    private static $_comparisonOperators = [
        '>=',
        '<=',
        '=',
        '>',
        '<',
    ];

    /**
     * @var array allowed logical operators
     * @todo append all logical operators support
     */
    private static $_logicalOperators = [
        'AND'
    ];

    /**
     * Returns all comparison operators list.
     *
     * @return array
     */
    public static function getComparisonOperators(): array
    {
        return static::$_comparisonOperators;
    }

    /**
     * Returns comparison operators concatenated into string with specific separator.
     *
     * @param string $separator
     * @return string
     */
    public static function getComparisonOperatorsString(string $separator): string
    {
        return implode($separator, static::$_comparisonOperators);
    }

    /**
     * Returns all logical operators list.
     *
     * @return array
     */
    public static function getLogicalOperators(): array
    {
        return static::$_logicalOperators;
    }

    /**
     * Returns logical operators concatenated into string with specific separator.
     *
     * @param string $separator
     * @return string
     */
    public static function getLogicalOperatorsString(string $separator): string
    {
        return implode($separator, static::$_logicalOperators);
    }
}
