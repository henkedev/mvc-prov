<?php

namespace Core\Action\Result;

use Core\App;
use Core\Action\Response;

class Page extends Response
{
    protected $content;

    /**
     * getContent
     *
     * @return string
     */
    public function getContent() : string
    {
        return $this->content;
    }

    public function send($view, $page = '')
    {
        $viewFile = '../App/view/' . $view . '.phtml';
                
        ob_start();
        
        if ($page) {
            $this->content = $viewFile;
            require('../App/view/' . $page . '.phtml');
        } else {
            require($viewFile);        
        }
        
        ob_flush();
    }
}