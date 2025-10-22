<?php

namespace bus\Project\core;

class Middleware
{
    private static $middlewares = [];

    public static function register($name, $middlewareClass)
    {
        self::$middlewares[$name] = $middlewareClass;
    }

    public static function getMiddleware($name)
    {
        return isset(self::$middlewares[$name]) ? new self::$middlewares[$name] : null;
    }

    public static function run($name)
    {
        if (!isset(self::$middlewares[$name])) {
            return true;
        }

        $middleware = new self::$middlewares[$name];
        if (method_exists($middleware, 'handle')) {
            return $middleware->handle();
        }

        return true;
    }
}
