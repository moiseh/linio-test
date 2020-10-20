<?php
namespace Challenger\Conditional;

class LinioRule implements RuleInterface {
    public function getLabel() {
        return 'Linio';
    }

    public function check($number) {
        return ( ( $number % 3 ) == 0 );
    }
}
