<?php

namespace Core;

class Container
{
    private $map = [];

    /**
     * Retreive a mapped class from the container
     *
     * @param  mixed $name
     * @param  mixed $params
     *
     * @return void
     */
    public function get($name, ...$params)
    {
        if (\array_key_exists($name, $this->map)) {
            if (\method_exists($this->map[$name], '__construct')) {
                return new $this->map[$name](...$params);
            } else {
                return new $this->map[$name]();
            }
        } else {
            throw new \Exception("Could not resolve requested class: " . $name);
        }
    }

    /**
     * Setup the container class mappings
     *
     * @return void
     */
    public function setup()
    {        
        $this->map['Request'] = \Core\Request::class;
        $this->map['Resource'] = \Core\Data\Resource::class;
        $this->map['Select'] = \Core\Data\Sql\Query\Select::class;
        $this->map['Insert'] = \Core\Data\Sql\Query\Insert::class;
        $this->map['Update'] = \Core\Data\Sql\Query\Update::class;
        $this->map['Delete'] = \Core\Data\Sql\Query\Delete::class;
        $this->map['IndexController'] = \App\Controller\IndexController::class;
        $this->map['PostsController'] = \App\Controller\PostsController::class;
        $this->map['Post'] = \App\Model\Post::class;
        $this->map['PostRepository'] = \App\Model\PostRepository::class;
        $this->map['Page'] = \Core\Action\Result\Page::class;
        $this->map['Redirect'] = \Core\Action\Result\Redirect::class;
        $this->map['Config'] = \Core\Config::class;
        $this->map['Router'] = \Core\Router::class;
        $this->map['MySqlDriver'] = \Core\Data\Driver\MySql::class;
        $this->map['PDO'] = \PDO::class;
    }
}