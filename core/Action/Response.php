<?php

namespace Core\Action;

abstract class Response
{
    private $data = array();
    
    public function setData($name, $value)
    {
        $this->data[$name] = $value;
    }
    
    public function getData($name = null)
    {
        if (is_null($name)) {
            return $this->data;
        }
        
        if (!isset($this->data[$name])) {
            return '';
        }
        
        return $this->data[$name];
    }

    public function hasData($name)
    {
        return $this->getData($name) !== '';
    }
}