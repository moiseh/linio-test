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
     * @var ConditionalCollection
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
     * @param ConditionalCollection $conditionals
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
     * @param ConditionalCollection $conditionals
     */
    public function setConditionals(ConditionalCollection $conditionals) {
        $this->conditionals = $conditionals;
    }

    /**
     * @return ConditionalCollection
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
        echo $this->getFormattedMessages();
        echo PHP_EOL;
    }

    /**
     * Get messages formatted with line break
     * 
     * @return string
     */
    public function getFormattedMessages() {
        return implode("\n", $this->getMessages());
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
            $number = 1;

            // execute validations only when execute (to avoid unnecessary processing)
            $range->validateRanges();
            $conditionals->validateConditionals();

            // run the loop
            while ( $number <= $end ) {
                foreach ( $conditionals as $rule ) {
                    if ( $rule->check($counter) ) {
                        $this->appendMessage( sprintf('%s: %s', $number, $rule->getLabel()) );
                        $number ++;
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