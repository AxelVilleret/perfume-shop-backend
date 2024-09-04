<?php

require_once 'src/lib/Response.php';
require_once 'config/constants.php';

abstract class Controller
{
    private IRepository $repository;

    public function __construct(IRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute($query, $instance, $method)
    {
        switch ($method) {
            case 'GET':
                if (isset($query['id'])) {
                    if (filter_var($query['id'], FILTER_VALIDATE_INT) !== false)
                        return $this->getById($query['id']);
                    else
                        throw new Exception(ERROR_INVALID_ID);
                } else {
                    return $this->getAll();
                }
                break;
            case 'POST':
                return $this->add($instance);
                break;
            case 'PUT':
                return $this->update($instance);
                break;
            case 'DELETE':
                if (isset($query['id'])) {
                    if (filter_var($query['id'], FILTER_VALIDATE_INT) !== false)
                        return $this->delete($query['id']);
                    else
                        throw new Exception(ERROR_INVALID_ID);
                } else {
                    throw new Exception(ERROR_MISSING_ID);
                }
                break;
            default:
                throw new Exception(ERROR_INVALID_METHOD);
        }
    }

    protected function getAll()
    {
        $objects = $this->repository->getAll();
        return Response::success(SUCCESS_OBJECTS_RETRIEVED, $objects, 200);
    }

    protected function getById($id)
    {
        $object = $this->repository->getById($id);
        return Response::success(SUCCESS_OBJECT_RETRIEVED, $object, 200);
    }

    protected function add($instance)
    {
        $object = $this->repository->add($instance);
        return Response::success(SUCCESS_OBJECT_ADDED, $object, 201);
    }

    protected function update($instance)
    {
        $object = $this->repository->update($instance);
        return Response::success(SUCCESS_OBJECT_UPDATED, $object, 200);
    }

    protected function delete($id)
    {
        $this->repository->delete($id);
        return Response::success(SUCCESS_OBJECT_DELETED, null, 200);
    }
}
