<?php

namespace Bossa\SimpleDbWrapper\Security;

trait Purify
{
    public function purifyTableName($tableName)
    {
        return "`" . preg_replace('/[^A-Za-z0-9_-]+/', '', $tableName) . "`";
    }
}