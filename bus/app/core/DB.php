<?php

namespace bus\Project\core;

use bus\Project\databases\Database;

class DB
{
    public static function table($table)
    {
        return new QueryBuilder((new Database())->getConnection(), $table);
    }
}