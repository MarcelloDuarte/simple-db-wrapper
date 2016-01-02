<?php

namespace Bossa\SimpleDbWrapper;

use Bossa\SimpleDbWrapper\DataStructure\Attribute;
use Bossa\SimpleDbWrapper\DataStructure\ResultSet;
use Bossa\SimpleDbWrapper\DataStructure\Tuple;

class Autowirer
{
    public function autowire($result)
    {
        switch(gettype($result)) {
            case 'array':
                if (!empty($result[0]) && is_array($result[0])) {
                    return $this->autowireResultSet($result);
                }
                return $this->autowireTuple($result);
                break;
            case 'string':
            case 'integer':
                return $this->autowireAttribute($result);
                break;
        }
    }

    private function autowireResultSet($result)
    {
        $tuples = [];
        foreach ($result as $key => $tuple) {
            $tuples[] = $this->autowireTuple($tuple);
        }
        return new ResultSet($tuples);
    }

    private function autowireTuple($result)
    {
        return new Tuple($result);
    }

    private function autowireAttribute($result)
    {
        return new Attribute($result);
    }
}