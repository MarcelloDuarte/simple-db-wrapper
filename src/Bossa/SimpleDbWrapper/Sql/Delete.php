<?php

namespace Bossa\SimpleDbWrapper\Sql;

use Bossa\SimpleDbWrapper\Autowirer;
use Bossa\SimpleDbWrapper\QueryRunner;

final class Delete
{
    private $queryRunner;
    private $autowirer;

    public function __construct(QueryRunner $queryRunner, Autowirer $autowirer)
    {
        $this->queryRunner = $queryRunner;
        $this->autowirer = $autowirer;
    }
} 