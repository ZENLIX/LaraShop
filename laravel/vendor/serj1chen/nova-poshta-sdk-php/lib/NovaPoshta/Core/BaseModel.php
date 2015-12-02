<?php

namespace NovaPoshta\Core;


abstract class BaseModel
{
    public function __construct()
    {
    }

    public function __set($name, $value)
    {
        $method = 'set' . $name;
        if (method_exists($this, $method)) {
            $this->{$method}($value);
        } else {
            $this->{$name} = $value;
        }
    }

    public function __get($name)
    {
        if (!property_exists($this, $name)) {
            $this->{$name} = null;
        };
        $method = 'get' . $name;
        if (method_exists($this, $method)) {
            return $this->{$method}();
        }
        return null;
    }
}