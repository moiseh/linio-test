<?php
namespace Challenger\Conditional;

class LinianosRule implements RuleInterface {
    public function getLabel() {
        return 'Linianos';
    }

    public function check($number) {
        return ( ( $number % 5 ) == 0 ) && ( ( $number % 3 ) == 0 );
    }
}
