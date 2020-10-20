<?php
require 'vendor/autoload.php';

use Challenger\Runner;
use Challenger\NumericRange;
use Challenger\ConditionalCollection;
use Challenger\Conditional\LinioRule;
use Challenger\Conditional\LinianosRule;
use Challenger\Conditional\ITRule;

$conditionals = new ConditionalCollection([
    new LinioRule(),
    new LinianosRule(),
    new ITRule(),
]);

$range = new NumericRange(1, 100);
$runner = new Runner($range, $conditionals);

if ( $runner->execute() ) {
    $runner->printForShell();
}
else {
    echo $runner->getErrorMessage() . PHP_EOL;
}