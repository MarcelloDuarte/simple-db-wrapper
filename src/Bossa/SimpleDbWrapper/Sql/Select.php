<?php

namespace Bossa\SimpleDbWrapper\Sql;

use Bossa\SimpleDbWrapper\Autowirer;
use Bossa\SimpleDbWrapper\Security\Purify;
use Bossa\SimpleDbWrapper\QueryRunner;

final class Select
{
    use Purify;
    private $queryRunner;
    private $autowirer;

    public function __construct(QueryRunner $queryRunner, Autowirer $autowirer)
    {
        $this->queryRunner = $queryRunner;
        $this->autowirer = $autowirer;
    }

    public function allFrom($tableName)
    {
        return $this->autowirer->autowire(
            $this->queryRunner->run('SELECT * FROM ' . $this->purifyTableName($tableName))->fetchAll()
        );
    }

    public function idFrom($tableName)
    {
        return $this->autowirer->autowire(
            $this->queryRunner->run('SELECT `id` FROM ' . $this->purifyTableName($tableName))->fetchColumn()
        );
    }

    public function findUnique($tableName, $condition)
    {
        return $this->autowirer->autowire(
            $this->queryRunner->run(
                'SELECT * FROM ' . $this->purifyTableName($tableName) . ' WHERE '
            )->fetchColumn()
        );
    }
}
