<?php

trait BehavesLikeArrayAccess
{
    /** @test */ function
    is_array_accessible()
    {
        $this->assertInstanceOf(ArrayAccess::class, $this->getArrayAccess());
    }

    /** @test */ function
    lets_you_access_with_array_notation()
    {
        $arrayAccess = ((new ReflectionClass($this->getArrayAccess()))->newInstanceArgs([['foo' => 'bar']]));
        $this->assertSame('bar', $arrayAccess['foo']);
    }

    /** @test */ function
    are_mutable()
    {
        $arrayAccess = ((new ReflectionClass($this->getArrayAccess()))->newInstanceArgs([['foo' => 'bar']]));
        $arrayAccess['foo'] = 'zoo';
        $this->assertSame('zoo', $arrayAccess['foo']);
    }

    /** @test */ function
    we_can_check_the_existence_of_a_key()
    {
        $arrayAccess = ((new ReflectionClass($this->getArrayAccess()))->newInstanceArgs([['foo' => 'bar']]));
        $this->assertTrue(isset($arrayAccess['foo']));
    }

    /** @test */ function
    lets_you_delete_keys()
    {
        $arrayAccess = ((new ReflectionClass($this->getArrayAccess()))->newInstanceArgs([['foo' => 'bar']]));
        unset($arrayAccess['foo']);
        $this->assertFalse(isset($arrayAccess['foo']));
    }
} 