<?php

use PHPUnit\Framework\TestCase;
require_once 'src/controllers/Controller.php';
require_once 'src/repositories/IRepository.php';

class ControllerTest extends TestCase
{
    private $repository;
    private $controller;

    protected function setUp(): void
    {
        $this->repository = $this->createMock(IRepository::class);
        $this->controller = $this->getMockForAbstractClass(Controller::class, [$this->repository]);
    }

    public function testGetAll()
    {
        $this->repository->method('getAll')->willReturn(['object1', 'object2']);
        $this->expectOutputString(json_encode([
            'status' => 'success',
            'message' => 'Objects retrieved successfully',
            'body' => ['object1', 'object2']
        ]));

        $this->controller->execute([], null, 'GET');
    }

    public function testGetById()
    {
        $this->repository->method('getById')->willReturn('object1');
        $this->expectOutputString(json_encode([
            'status' => 'success',
            'message' => 'Object retrieved successfully',
            'body' => 'object1'
        ]));

        $this->controller->execute(['id' => 1], null, 'GET');
    }

    public function testAdd()
    {
        $instance = 'newObject';
        $this->repository->method('add')->willReturn($instance);
        $this->expectOutputString(json_encode([
            'status' => 'success',
            'message' => 'Object added successfully',
            'body' => $instance
        ]));

        $this->controller->execute([], $instance, 'POST');
    }

    public function testUpdate()
    {
        $instance = 'updatedObject';
        $this->repository->method('update')->willReturn($instance);
        $this->expectOutputString(json_encode([
            'status' => 'success',
            'message' => 'Object updated successfully',
            'body' => $instance
        ]));

        $this->controller->execute([], $instance, 'PUT');
    }

    public function testDelete()
    {
        $this->expectOutputString(json_encode([
            'status' => 'success',
            'message' => 'Object deleted successfully',
        ]));

        $this->controller->execute(['id' => 1], null, 'DELETE');
    }
}
