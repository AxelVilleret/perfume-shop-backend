<?php

class Controller
{
    public function execute($get, $post, $method)
    {
        switch ($method) {
            case 'GET':
                $this->getAll();
                break;
            default:
                throw new Exception("Invalid request method.");
        }
    }

    protected function getAll()
    {
        throw new Exception("Invalid request method.");
    }
}