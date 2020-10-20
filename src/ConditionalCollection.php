<?php
namespace Challenger;

class ConditionalCollection implements \Countable, \Iterator, \ArrayAccess {
    private $values = [];
    private $position = 0;

    public function __construct(array $values = []) {
        foreach ($values as $value) {
            $this->offsetSet('', $value);
        }
    }

    public function count() {
        return count($this->values);
    }

    public function rewind() {
        $this->position = 0;
    }

    public function key() {
        return $this->position;
    }

    public function current() {
        return $this->values[$this->position];
    }

    public function next() {
        $this->position++;
    }

    public function valid() {
        return isset($this->values[$this->position]);
    }

    public function offsetExists($offset) {
        return isset($this->values[$offset]);
    }

    public function offsetGet($offset) {
        return $this->values[$offset];
    }

    public function offsetSet($offset, $value) {
        if (empty($offset)) {
            $this->values[] = $value;
        }
        else {
            $this->values[$offset] = $value;
        }
    }

    public function offsetUnset($offset) {
        unset($this->values[$offset]);
    }
}