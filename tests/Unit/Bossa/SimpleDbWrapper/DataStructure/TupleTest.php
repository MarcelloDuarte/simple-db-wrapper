<?php

namespace Unit\Bossa\SimpleDbWrapper\DataStructure;

use BehavesLikeArrayAccess;
use Bossa\SimpleDbWrapper\DataStructure\Tuple;
use PHPUnit_Framework_TestCase as TestCase;

class TupleTest extends TestCase
{
    use BehavesLikeArrayAccess;

    function getArrayAccess()
    {
        return new Tuple;
    }
} 