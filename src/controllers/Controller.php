<?php

abstract class Controller
{
    protected Repository $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }
    
    public function execute($query, $instance, $method)
    {
        switch ($method) {
            case 'GET':
                if (isset($query['id'])) {
                    $this->getById($query['id']);
                } else {
                    $this->getAll();
                }
                break;
            case 'POST':
                $this->add($instance);
                break;
            case 'PUT':
                $this->update($instance);
                break;
            case 'DELETE':
                $this->delete($query['id']);
                break;
            default:
                throw new Exception("Invalid request method.");
        }
    }

    protected function getAll()
    {
        $objects = $this->repository->getAll();
        echo json_encode($objects);
    }

    protected function getById($id)
    {
        $object = $this->repository->getById($id);
        echo json_encode($object);
    }

    protected function add($instance)
    {
        $res = $this->repository->add($instance);
        if($res){
            echo json_encode(['message' => 'Object added successfully']);
        }else{
            echo json_encode(['message' => 'Error adding object']);
        }
    }

    protected function update($instance)
    {
        $res = $this->repository->update($instance);
        if($res){
            echo json_encode(['message' => 'Object updated successfully']);
        }else{
            echo json_encode(['message' => 'Error updating object']);
        }
    }

    protected function delete($id)
    {
        $res = $this->repository->delete($id);
        if($res){
            echo json_encode(['message' => 'Object deleted successfully']);
        }else{
            echo json_encode(['message' => 'Error deleting object']);
        }
    }

}