<?php

interface IRepository
{
    public function getAll(): array;
    public function getById(int $id): Entity;
    public function add(Entity $instance): Entity;
    public function update(Entity $instance): Entity;
    public function delete(int $id): void;
}