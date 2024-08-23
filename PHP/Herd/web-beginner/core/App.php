<?php

namespace Core;

class App
{
    protected static $container;

    public static function setContainer(Container $container)
    {
        //App::$container also works
        static::$container = $container;
    }

    public static function bind($container)
    {
        App::setContainer($container);
    }

    public static function resolve($key)
    {
        return static::$container->resolve($key);
    }
}
