<?php

namespace App\Controller;

use Core\App;
use Core\Controller;

class IndexController extends Controller
{
    /**
     * Show a list of all available posts
     *
     * @return void
     */
    public function index()
    {
        $repo = App::getContainer()->get('PostRepository');
        $posts = $repo->findAll();

        $result = App::getContainer()->get('Page');
        $result->setData('posts', $posts);
        $result->send('index', 'master');
    }
}