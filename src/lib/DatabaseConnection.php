<?php

class DatabaseConnection
{
    private ?\PDO $database = null;

    public function getConnection(): \PDO
    {
        if ($this->database === null) {
            $this->database = new \PDO('mysql:host=localhost;dbname=perfume-shop;charset=utf8', 'root', '');
        }

        return $this->database;
    }
}
