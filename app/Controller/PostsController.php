<?php

namespace App\Controller;

use Core\App;
use Core\Controller;

class PostsController extends Controller
{
    /**
     * Load post and redirect to edit page
     *
     * @return void
     */
    public function edit()
    {
        $repo = App::getContainer()->get('PostRepository');
        $id = $this->getRequest()->getParam('id');

        $post = $repo->load($id);
        if ($post && $post->id) {
            $result = App::getContainer()->get('Page');
            $result->setData('post', $post);
            $result->send('edit', 'master');    
        } else {
            $result = App::getContainer()->get('Redirect');
            $result->send('/');
        }
    }

    /**
     * Save changes to post from the edit page
     *
     * @return void
     */
    public function save()
    {
        $repo = App::getContainer()->get('PostRepository');
        $id = $this->getRequest()->getParam('id');

        $post = $repo->load($id);
        if ($post && $post->id) {
            $post->title = $this->getRequest()->getParam('title');
            $post->description = $this->getRequest()->getParam('description');
    
            $errors = $post->validate();
            if (empty($errors)) {
                $repo->update($post);
            }            
        }

        $result = App::getContainer()->get('Redirect');
        $result->send('/');
    }

    /**
     * Redirect to blank form page for a new post
     *
     * @return void
     */
    public function create()
    {
        $result = App::getContainer()->get('Page');
        $result->send('create', 'master');
    }

    /**
     * Create a new post from the create page
     *
     * @return void
     */
    public function store()
    {
        $repo = App::getContainer()->get('PostRepository');
        $post = App::getContainer()->get('Post');

        $post->title = $this->getRequest()->getParam('title');
        $post->description = $this->getRequest()->getParam('description');

        $errors = $post->validate();
        if (empty($errors)) {
            $repo->save($post);
        }

        $result = App::getContainer()->get('Redirect');
        $result->send('/');
    }

    /**
     * Delete a specific post
     *
     * @return void
     */
    public function delete()
    {
        $repo = App::getContainer()->get('PostRepository');
        $id = $this->getRequest()->getParam('id');
        
        $post = $repo->load($id);
        if ($post && $post->id) {
            $repo->delete($post);
        }        

        $result = App::getContainer()->get('Redirect');
        $result->send('/');
    }
}