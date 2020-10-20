<?php
use PHPUnit\Framework\TestCase;

use Challenger\NumericRange;
use Challenger\NumericRangeException;

final class NumericRangeTest extends TestCase
{
    public function testRangeValidation(): void
    {
        $this->expectException(NumericRangeException::class);

        // define invalid start range to check if exception will thrown
        $range = new NumericRange(1000, 100);
        $range->validateRanges();
    }

}