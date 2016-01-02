<?php

namespace Bossa\SimpleDbWrapper;

use PDO;

final class QueryRunner
{
    private $connection;

    public function __construct(PDO $connection)
    {
        $this->connection = $connection;
    }

    public function run($query)
    {
        $statement = $this->connection->prepare($query);
        $statement->execute();

        return $statement;
    }
} 