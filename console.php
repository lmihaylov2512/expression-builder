#!/usr/bin/env php
<?php

require(__DIR__ . '/vendor/autoload.php');

use ExpressionBuilder\{
    Builder, Parser
};

// define allowed data types
$dataTypes = [
    'age' => 'integer',
    'country' => 'string',
];

// define expressions list
$expressions = [
    '(age=31)',
    '(country="BG")',
    '(age>=18 AND age<=50)',
    '(country="BG" AND age>=18)',
    '(age<=35 AND age=40 AND country="FR")',
];

// Parse the expressions and provide object oriented interface to edit the expression
$builder = new Builder;
$parser = new Parser($builder, $dataTypes);

foreach ($expressions as $exprString) {
    $expression = $parser->parse($exprString);
    var_dump($expression);
}

var_dump($builder->build($expression));
