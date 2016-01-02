<?php

namespace Bossa\SimpleDbWrapper\DataStructure;

use ArrayAccess;
use Countable;
use Iterator;

final class ResultSet implements ArrayAccess, Iterator, Countable
{
    private $tuples;

    public function __construct(array $tuples = [])
    {
        $this->tuples = $tuples;
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->tuples);
    }

    public function offsetGet($offset)
    {
        return $this->tuples[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->tuples[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->tuples[$offset]);
    }

    public function current()
    {
        // TODO: Implement current() method.
    }

    public function next()
    {
        // TODO: Implement next() method.
    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    public function count()
    {
        return count($this->tuples);
    }
}