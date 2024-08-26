<?php

require_once 'src/lib/Response.php';

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
                    if (filter_var($query['id'], FILTER_VALIDATE_INT) !== false)
                        $this->getById($query['id']);
                    else
                        throw new Exception("Invalid id parameter.");
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
                if (isset($query['id'])) {
                    if (filter_var($query['id'], FILTER_VALIDATE_INT) !== false)
                        $this->delete($query['id']);
                    else
                        throw new Exception("Invalid id parameter.");
                } else {
                    throw new Exception("Missing id parameter.");
                }
                break;
            default:
                throw new Exception("Invalid request method.");
        }
    }

    protected function getAll()
    {
        $objects = $this->repository->getAll();
        Response::sendSuccess('Objects retrieved successfully', $objects, 200);
    }

    protected function getById($id)
    {
        $object = $this->repository->getById($id);
        Response::sendSuccess('Object retrieved successfully', $object, 200);
    }

    protected function add($instance)
    {
        $object = $this->repository->add($instance);
        Response::sendSuccess('Object added successfully', $object, 201);
    }

    protected function update($instance)
    {
        $object = $this->repository->update($instance);
        Response::sendSuccess('Object updated successfully', $object, 200);
    }

    protected function delete($id)
    {
        $res = $this->repository->delete($id);
        if($res){
            Response::sendSuccess('Object deleted successfully', [], 204);
        }else{
            Response::sendError('Error deleting object', 400);
        }
    }

}