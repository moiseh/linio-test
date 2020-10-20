<?php
use PHPUnit\Framework\TestCase;

use Challenger\Runner;
use Challenger\NumericRange;
use Challenger\ConditionalCollection;
use Challenger\Conditional\LinioRule;
use Challenger\Conditional\LinianosRule;
use Challenger\Conditional\ITRule;

final class RunnerTest extends TestCase
{
    public function testInvalidConditionals(): void
    {
        // define empty conditionals to assert the exception will thrown
        $conditionals = new ConditionalCollection();
    
        $range = new NumericRange(1, 100);
        $runner = new Runner($range, $conditionals);

        // assert execution failed (that is correct because the empty conditionals)
        $this->assertFalse(
            $runner->execute()
        );

        // assert conditional invalid error message
        $this->assertEquals(
            $runner->getErrorMessage(),
            'You need to define at least one conditional'
        );
    }

    public function testFailExecution(): void
    {
        $conditionals = $this->getConditionals();
        
        // sets invalid start range value
        $range = new NumericRange(200, 100);

        $runner = new Runner($range, $conditionals);

        // assert execution failed
        $this->assertFalse($runner->execute());
    }

    public function testSuccesssExecution(): void
    {
        $conditionals = $this->getConditionals();

        // sets invalid start range value
        $range = new NumericRange(1, 100);

        $runner = new Runner($range, $conditionals);

        // assert execution successfully executed
        $this->assertTrue(
            $runner->execute()
        );

        // assert if the output is the expected file result 
        $this->assertStringMatchesFormatFile(
            __DIR__ . '/RunnerTestOutput.txt',
            $runner->getFormattedMessages() . PHP_EOL
        );
    }

    /**
     * @return ConditionalCollection
     */
    private function getConditionals() {
        $conditionals = new ConditionalCollection([
            new LinioRule(),
            new LinianosRule(),
            new ITRule(),
        ]);
        
        return $conditionals;
    }
}