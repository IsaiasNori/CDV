<?php

abstract class Model
{
    protected $values = [];
    function __construct(array $params)
    {
        $this->loadFieldsFromArray($params);
    }

    private function loadFieldsFromArray($arr)
    {
        if ($arr) {
            foreach ($arr as $key => $value) {
                $this->__set($key, $value);
            }
        }
    }

    public function __get($key)
    {
        return $this->values[$key];
    }

    public function __set($key, $value)
    {
        $this->values[$key] = $value;
    }
}
