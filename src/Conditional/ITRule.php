<?php
namespace Challenger\Conditional;

class ITRule implements RuleInterface {
    public function getLabel() {
        return 'IT';
    }

    public function check($number) {
        return ( ( $number % 5 ) == 0 );
    }
}
