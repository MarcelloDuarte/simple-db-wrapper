<?php

namespace Bossa\SimpleDbWrapper;

use Bossa\SimpleDbWrapper\Sql\Delete;
use Bossa\SimpleDbWrapper\Sql\Insert;
use Bossa\SimpleDbWrapper\Sql\Select;
use Bossa\SimpleDbWrapper\Sql\Update;
use PDO;

class SqlFactory
{
    private $select;
    private $insert;
    private $delete;
    private $update;

    public function __construct(
        PDO $connection, Select $select = null, Insert $insert = null, Delete $delete = null, Update $update = null
    )
    {
        $this->select = $select ?: new Select(new QueryRunner($connection), new Autowirer());
        $this->insert = $insert ?: new Insert(new QueryRunner($connection), new Autowirer());
        $this->delete = $delete ?: new Delete(new QueryRunner($connection), new Autowirer());
        $this->update = $update ?: new Update(new QueryRunner($connection), new Autowirer());
    }

    public function delete()
    {
        return $this->delete;
    }

    public function insert()
    {
        return $this->insert;
    }

    public function select()
    {
        return $this->select;
    }

    public function update()
    {
        return $this->update;
    }
}