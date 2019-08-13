<?php

namespace Core;

final class App
{
    private static $config;
    private static $container;

    public static function getConfig()
    {
        return self::$config;
    }

    public static function getContainer()
    {
        return self::$container;
    }

    public function run($uri, $method)
    {
        # container
        self::$container = new Container();
        self::$container->setup();
        
        # config
        self::$config = self::getContainer()->get('Config');
        self::$config->setup();

        # routing
        $router = self::getContainer()->get('Router');
        $router->setup();
        $router->resolve($uri, $method);
    }
}
