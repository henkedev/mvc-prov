<?php

namespace Core;

class Config
{
    private $data = [];

    /**
     * setData
     *
     * @param  mixed $key
     * @param  mixed $value
     *
     * @return void
     */
    private function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * getData
     *
     * @param  mixed $key
     *
     * @return string
     */
    public function getData($key) : string
    {
        if (\key_exists($key, $this->data)) {
            return $this->data[$key];
        } else {
            return null;
        }
    }

    /**
     * setup
     * 
     * Get the config data from an XML file
     *
     * @return void
     */
    public function setup()
    {
        $xml = simplexml_load_file('../app/config.xml');
                
        $this->setData('database/host', (string)$xml->database->host);
        $this->setData('database/name', (string)$xml->database->name);
        $this->setData('database/user', (string)$xml->database->user);
        $this->setData('database/pass', (string)$xml->database->pass);
        $this->setData('web/base_url', (string)$xml->web->base_url);
    }
}