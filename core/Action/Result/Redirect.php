<?php

namespace Core\Action\Result;

use Core\App;
use Core\Action\Response;

class Redirect extends Response
{
    public function send($url)
    {
        $baseURL = App::getConfig()->getData('web/base_url');

        header("Location: $baseURL$url");
    }
}