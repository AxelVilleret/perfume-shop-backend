<?php

abstract class Repository 
{

    protected DatabaseConnection $connection;

    public function __construct()
    {
        $this->connection = new DatabaseConnection();
    }

    public function getAll(): array
    {
        $entity = $this->getClassPrefix();
        $statement = $this->connection->getConnection()->query(
            "SELECT * FROM " . $entity . " ORDER BY id_client"
        );
        $objects = [];
        while (($row = $statement->fetch())) {
            $object = new $entity();
            foreach ($row as $key => $value) {
                $object->$key = $value;
            }
            $objects[] = $object;
        }
        return $objects;
    }

    public function getById(int $id): object
    {
        echo $this->getClassPrefix();
        throw new Exception("Method not implemented.");
    }

    public function add(array $body): bool
    {
        throw new Exception("Method not implemented.");
    }

    public function update(array $body): bool
    {
        throw new Exception("Method not implemented.");
    }

    public function delete(int $id): bool
    {
        throw new Exception("Method not implemented.");
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