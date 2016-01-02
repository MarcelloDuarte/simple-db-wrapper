<?php

namespace Unit\Bossa\SimpleDbWrapper\DataStructure;

use ArrayAccess;
use BehavesLikeArrayAccess;
use Bossa\SimpleDbWrapper\DataStructure\ResultSet;
use Bossa\SimpleDbWrapper\DataStructure\Tuple;
use Countable;
use Iterator;
use PHPUnit_Framework_TestCase as TestCase;

class ResultSetTest extends TestCase
{
    use BehavesLikeArrayAccess;

    function getArrayAccess()
    {
        return new ResultSet;
    }

    /** @test */ function
    it_is_array_accessible_iteratable_and_countable()
    {
        $this->assertInstanceOf(ArrayAccess::class, new ResultSet());
        $this->assertInstanceOf(Iterator::class, new ResultSet());
        $this->assertInstanceOf(Countable::class, new ResultSet());
    }

    /** @test */ function
    it_is_created_empty()
    {
        $this->assertCount(0, new ResultSet());
    }

    /** @test */ function
    it_can_be_created_with_an_array_of_tuples()
    {
        $this->assertCount(1, new ResultSet(array(new Tuple())));
    }
}