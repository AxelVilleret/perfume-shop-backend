<?php

abstract class Entity
{
    public int $id;
    protected array $requiredFields = [];

    public function __construct(array $data)
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
        $this->validate();
    }

    private function validate()
    {
        foreach ($this->requiredFields as $field) {
            if (empty($this->$field)) {
                throw new Exception("The field $field is required.");
            }
        }
    }
}