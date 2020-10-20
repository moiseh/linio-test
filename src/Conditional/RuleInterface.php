<?php
namespace Challenger\Conditional;

interface RuleInterface {
    public function check($number);
    public function getLabel();
}
