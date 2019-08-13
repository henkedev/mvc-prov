<?php

namespace Core;

use Core\Request;

final class Router
{
    private $routes = [];

    private function add($method, $url, $controller, $action, $param)
    {
        $name = $this->getRouteName($url, $method);
        $route = ['method' => $method, 'url' => $url, 'controller' => $controller, 'action' => $action, 'param' => $param];
        
        $this->routes[$name] = $route;
    }

    private function getRouteName($uri, $method) : string
    {
        return $method . '_' . trim($uri, "\x2F");
    }

    public function setup()
    {
        $xml = simplexml_load_file('../App/routes.xml');        
        foreach ($xml as $key => $item) {
            if ($key === 'route') {
                $param = isset($item['param']) ? (string) $item['param'] : '';

                $this->add( 
                    (string) $item['method'], 
                    (string) $item['url'], 
                    (string) $item['controller'], 
                    (string) $item['action'], 
                    $param);
            }
        }
    }

    private function getParams($path)
    {        
        $params = array_merge($_POST, $_REQUEST);

        return $params;
    }

    public function resolve($uri, $method)
    {
        $paramValue = '';
        $path = explode('/', trim($uri, '/'));
        if (isset($path[2])) {
            $paramValue = $path[2];
            $uri = $path[0] . '/' . $path[1];
        }

        $name = $this->getRouteName($uri, $method);
        $params = $this->getParams($path);
        
        if (\array_key_exists($name, $this->routes)) {            
            $route = $this->routes[$name];

            if ($paramValue !== '' && $route['param'] !== '') {
                $params[$route['param']] = $paramValue;
            }

            $controllerName = $route['controller'];
            $actionName = $route['action'];
            $className = "\\App\\Controller\\" . $controllerName;

            try {
                $request = App::getContainer()->get('Request', $params);
                $controller = App::getContainer()->get($controllerName, $request);
                $controller->$actionName();
            } catch (\Exception $e) {
                die($e->getMessage());
            }
        } else {
            die('404 - not found');
        }
    }   
}