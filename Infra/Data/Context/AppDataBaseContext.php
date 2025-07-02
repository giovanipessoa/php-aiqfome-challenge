<?php

namespace Infra\Data\Context;

use Infra\Data\Interfaces\Database\IDatabase;
use PDO;

class AppDataBaseContext implements IDatabase
{
    private PDO $connection;

    public function __construct()
    {
        $config = require __DIR__ . '/../Config/database.php';

        $dsn = "{$config['driver']}:host={$config['host']};dbname={$config['dbname']};port={$config['port']};charset={$config['charset']}";
        $user = $config['user'];
        $password = $config['password'];

        $this->connection = new PDO(
            $dsn,
            $user,
            $password
        );
    }

    public function getConnection(): PDO
    {
        return $this->connection;
    }
}
