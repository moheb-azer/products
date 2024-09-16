<?php

namespace Core;

class Container
{
    protected array $bindings = [];
    public function bind($key, $value)
    {
        $this->bindings[$key] = $value;
    }


    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("The key '{$key}' does not exist.");
        }
        $resolver = $this->bindings[$key];
        return call_user_func($resolver);
    }
}