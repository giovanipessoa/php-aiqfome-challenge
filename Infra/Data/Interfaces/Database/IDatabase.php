<?php

namespace Infra\Data\Interfaces\Database;

use PDO;

interface IDatabase
{
    public function getConnection(): PDO;
}
