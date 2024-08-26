<?php

require_once 'src/lib/DatabaseConnection.php';
require_once 'src/repositories/IRepository.php';

abstract class Repository implements IRepository
{

    private DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }


    private function isExisting(int $id): bool
    {
        $entity = $this->getClassPrefix();
        $statement = $this->connection->getConnection()->prepare(
            "SELECT COUNT(*) FROM " . $entity . " WHERE id = :id"
        );
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
        return $statement->fetchColumn();
    }

    public function getAll(): array
    {
        $entity = $this->getClassPrefix();
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM " . $entity . " ORDER BY id"
        );
        $instances = [];
        while (($row = $statement->fetch(\PDO::FETCH_ASSOC))) {
            $instance = new $entity($row);
            $instances[] = $instance;
        }
        return $instances;
    }

    public function getById(int $id): Entity
    {
        $entity = $this->getClassPrefix();
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM " . $entity . " WHERE id = " . $id
        );
        $row = $statement->fetch(\PDO::FETCH_ASSOC);
        if (!$row) {
            throw new Exception("Object not found.");
        }
        $instance = new $entity($row);
        return $instance;
    }

    public function add(Entity $instance): Entity
    {
        $entity = $this->getClassPrefix();
        $fields = '';
        $values = '';
        foreach ($instance as $key => $value) {
            $fields .= $key . ', ';
            $values .= "'" . $value . "', ";
        }
        $fields = substr($fields, 0, -2);
        $values = substr($values, 0, -2);
        $statement = $this->connection->getConnection()->prepare(
            "INSERT INTO " . $entity . " (" . $fields . ") VALUES (" . $values . ")"
        );
        $res = $statement->execute();
        if (!$res) {
            throw new Exception("Error inserting object.");
        }
        $instance->id = $this->connection->getConnection()->lastInsertId();
        return $instance;
    }

    public function update(Entity $instance): Entity
    {
        $entity = $this->getClassPrefix();
        if (!isset($instance->id)) {
            throw new Exception("Missing id parameter.");
        }
        if (!$this->isExisting($instance->id)) {
            throw new Exception("Object not found.");
        }
        $fields = '';
        foreach ($instance as $key => $value) {
            $fields .= $key . " = '" . $value . "', ";
        }
        $fields = substr($fields, 0, -2);
        $statement = $this->connection->getConnection()->prepare(
            "UPDATE " . $entity . " SET " . $fields . " WHERE id = " . $instance->id
        );
        $res = $statement->execute();
        if (!$res) {
            throw new Exception("Error updating object.");
        }
        return $instance;
    }

    public function delete(int $id): bool
    {
        $entity = $this->getClassPrefix();
        $exists = $this->isExisting($id);
        if ($exists) {
            $statement = $this->connection->getConnection()->prepare(
                "DELETE FROM " . $entity . " WHERE id = :id"
            );
            $statement->bindParam(':id', $id, PDO::PARAM_INT);
            return $statement->execute();
        } else {
            return false;
        }
    }


    private function getClassPrefix(): string
    {
        $className = get_class($this);
        $position = strpos($className, 'Repository');
        if ($position !== false) {
            return substr($className, 0, $position);
        }
        return '';
    }

}