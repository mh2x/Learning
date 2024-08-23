<?php

namespace Core;

class Container
{
    protected $bindings = [];

    public function bind($key, $resolver /*func*/)
    {
        $this->bindings[$key] = $resolver;
    }

    public function resolve($key)
    {
        if (!array_key_exists($key, $this->bindings)) {
            throw new \Exception("Couldn't resolve {$key}. Make sure to bind it first");
        }

        $resolver = $this->bindings[$key];
        return call_user_func($resolver);
    }
}
