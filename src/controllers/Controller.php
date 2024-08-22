<?php

require_once('src/model/Repository.php');

abstract class Controller
{
    protected Repository $repository;
    
    public function execute($get, $post, $method)
    {
        switch ($method) {
            case 'GET':
                if (isset($get['id'])) {
                    $this->getById($get['id']);
                } else {
                    $this->getAll();
                }
                break;
            case 'POST':
                $this->add($post);
                break;
            case 'PUT':
                $this->update($post);
                break;
            case 'DELETE':
                $this->delete($get['id']);
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

    protected function add($post)
    {
        $res = $this->repository->add($post);
        if($res){
            echo json_encode(['message' => 'Object added successfully']);
        }else{
            echo json_encode(['message' => 'Error adding object']);
        }
    }

    protected function update($post)
    {
        $res = $this->repository->update($post);
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