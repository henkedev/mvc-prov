<?php

namespace Core;

class Request
{
    private $params = array();
    
    public function __construct($params) {
        $this->params = $params;
    }
    
    public function setParam($key, $value)
    {
        $this->param[$key] = $value;
    }

    public function getParam($key)
    {
        if (isset($this->params[$key])) {
            return $this->params[$key];
        } else {
            return '';
        }
    }

    public function getParams()
    {
        return $this->params;
    }    

    public function hasParam($key)
    {
        return $this->getParam($key) !== '';
    }
}