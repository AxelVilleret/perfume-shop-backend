<?php

require_once 'vendor/autoload.php';

use Dotenv\Dotenv;

class DatabaseConnection
{
    private ?\PDO $database = null;

    public function __construct()
    {
        $projectRoot = dirname(__DIR__, 2);
        $dotenv = Dotenv::createImmutable($projectRoot);
        $dotenv->load();
    }

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $host = $_ENV['DB_HOST'];
            $dbname = $_ENV['DB_NAME'];
            $charset = $_ENV['DB_CHARSET'];
            $user = $_ENV['DB_USER'];
            $password = $_ENV['DB_PASS'];

            $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
            $this->database = new \PDO($dsn, $user, $password);
        }

        return $this->database;
    }
}
