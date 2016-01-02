<?php

namespace Bossa\SimpleDbWrapper;

use PDO;

final class SimpleDbWrapper
{
    private $connection;
    private $sqlFactory;

    public function __construct(Pdo $connection, SqlFactory $sqlFactory = null)
    {
        $this->connection = $connection;
        $this->sqlFactory = $sqlFactory ?: new SqlFactory($connection);
    }

    public function selectAllFrom($tableName)
    {
        return $this->select()->allFrom($tableName);
    }

    private function select()
    {
        return $this->sqlFactory->select();
    }
} 