<?php

namespace Bossa\SimpleDbWrapper\DataStructure;

use ArrayAccess;

final class Tuple implements ArrayAccess
{
    private $attributes;

    public function __construct(array $attributes = [])
    {
        foreach ($attributes as $key => $value) {
            if (!is_numeric($key)) {
                $this->attributes[$key] = $value;
            }
        }
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->attributes);
    }

    public function offsetGet($offset)
    {
        return $this->attributes[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->attributes[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }
}