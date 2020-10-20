<?php
namespace Challenger;

use Exception;

class Runner {
    /**
     * Numeric ranges object
     * 
     * @var array
     */
    private $range;

    /**
     * Conditional rules array
     * 
     * @var array
     */
    private $conditionals;

    /**
     * Error string
     * 
     * @var string
     */
    private $error;

    /**
     * Output messages array
     * 
     * @var array
     */
    private $messages;

    /**
     * Constructor method
     * 
     * @param NumericRange $range
     * @param RuleInterface $conditionals
     */
    public function __construct(NumericRange $range, ConditionalCollection $conditionals) {
        $this->setRange($range);
        $this->setConditionals($conditionals);
    }

    /**
     * @param NumericRange $range
     */
    public function setRange($range) {
        $this->range = $range;
    }

    /**
     * @return NumericRange
     */
    public function getRange() {
        return $this->range;
    }

    /**
     * @param array $conditionals
     */
    public function setConditionals($conditionals) {
        $this->conditionals = $conditionals;
    }

    /**
     * @return array
     */
    public function getConditionals() {
        return $this->conditionals;
    }

    /**
     * Get output messages
     * 
     * @return array
     */
    public function getMessages() {
        return $this->messages ?: [];
    }

    /**
     * Appends a new message
     * 
     * @param string $line
     */
    public function appendMessage($line) {
        $this->messages[] = $line;
    }

    /**
     * Return the executor error, when it exists
     * 
     * @return string
     */
    public function getErrorMessage() {
        return $this->error;
    }

    /**
     * Print in a nicer way to display on shell
     */
    public function printForShell() {
        foreach ( $this->getMessages() as $line ) {
            echo $line . PHP_EOL;
        }
    }

    /**
     * Run the main application
     * 
     * @return bool TRUE when sucessfully run, FALSE when error
     */
    public function execute() {
        try {
            // get required variables
            $range = $this->getRange();
            $counter = $range->getStart();
            $end = $range->getEnd();
            $conditionals = $this->getConditionals();

            // execute range validation only when execute (to avoid unnecessary processing)
            $range->validateRanges();

            // run the loop
            while ( $counter <= $end ) {
                foreach ( $conditionals as $rule ) {
                    if ( $rule->check($counter) ) {
                        $this->appendMessage( $rule->getLabel() );
                    }
                }

                $counter ++;
            }

            return true;
        }
        catch (Exception $e) {
            // assign error to check outside application if necessary
            $this->error = $e->getMessage();

            return false;
        }
    }
}