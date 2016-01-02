<?php

namespace Unit\Bossa\SimpleDbWrapper\Security;

use Bossa\SimpleDbWrapper\Security\Purify;
use PHPUnit_Framework_TestCase as TestCase;

final class PurifyTest extends TestCase
{
    use Purify;

    /** @test */ function
    it_adds_back_tick_to_simple_strings()
    {
        $this->assertEquals('`tableName`', $this->purifyTableName("tableName"));
    }

    /** @test */ function
    it_removes_anything_that_is_not_letters_numbers_underscores()
    {
        $this->assertEquals('`t1_f6`', $this->purifyTableName("t` 1_f[*#6"));
    }
}