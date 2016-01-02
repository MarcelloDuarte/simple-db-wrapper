<?php

namespace Integration\Bossa\SimpleDbWrapper;

use Bossa\SimpleDbWrapper\DataStructure\ResultSet;
use Bossa\SimpleDbWrapper\DataStructure\Tuple;
use Bossa\SimpleDbWrapper\SimpleDbWrapper;
use DbTestHelper;
use PHPUnit_Extensions_Database_TestCase as DatabaseTestCase;

final class SimpleDbWrapperTest extends DatabaseTestCase
{
    use DbTestHelper;

    /** @test */ function it_lets_you_select_all_tuples_from_a_table()
    {
        $simpleDbWrapper = new SimpleDbWrapper(self::$pdo);
        $resultSet = $simpleDbWrapper->selectAllFrom('guestbook');
        $this->assertEquals(new ResultSet([
            new Tuple(['id' => '1', 'content' => 'Hello buddy!', 'user' => 'joe', 'created' => '2010-04-24 17:15:23']),
            new Tuple(['id' => '2', 'content' => 'I like it!', 'user' => 'nancy', 'created' => '2010-04-26 12:14:20'])
        ]), $resultSet);
    }
}