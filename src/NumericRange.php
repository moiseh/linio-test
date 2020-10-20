<?php
namespace Challenger;

class NumericRange {
    /**
     * Start number range
     * 
     * @var int
     */
    private $start;

    /**
     * End number range
     * 
     * @var int
     */
    private $end;

    /**
     * Constructor method
     * 
     * @param int $start
     * @param int $end
     */
    public function __construct($start = null, $end = null) {
        $this->setStart( $start ?: 1 );
        $this->setEnd( $end ?: 100 );
    }

    /**
     * @param int $start
     */
    public function setStart($start) {
        $this->start = $start;
    }

    /**
     * @return int
     */
    public function getStart() {
        return $this->start;
    }

    /**
     * @param int $end
     */
    public function setEnd($end) {
        $this->end = $end;
    }

    /**
     * @return int
     */
    public function getEnd() {
        return $this->end;
    }

    /**
     * Execute range validation
     * 
     * @throws Exception
     */
    public function validateRanges() {
        $start = $this->getStart();
        $end = $this->getEnd();

        if ( $start > $end ) {
            throw new NumericRangeException( sprintf('The start value (%s) cannot be greater than end value (%s)', $start, $end) );
        }
    }
}
