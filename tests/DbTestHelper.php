<?php

trait DbTestHelper
{
    static protected $pdo = null;
    protected $conn = null;

    final public function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO('sqlite:' . getcwd() . '/tests/fixtures/db.db');
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, './fixtures/db.db');
        }

        return $this->conn;
    }

    public function getDataSet()
    {
        return $this->createFlatXmlDataSet(getcwd() . '/tests/fixtures/StartingState.xml');
    }
} 