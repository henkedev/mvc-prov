<?php

namespace App\Model;

use Core\App;
use App\Model\Post;

class PostRepository
{
    protected $resource;

    /**
     * Fetch and store a new resource object
     *
     * @return void
     */
    public function __construct()
    {
        $this->resource = App::getContainer()->get('Resource');
    }
    
    /**
     * Get an array of all Post objects
     *
     * @return array
     */
    public function findAll() : array
    {
        $builder = App::getContainer()->get('Select');        
        $builder->select($this->getColumns())
                ->from('posts');

        $collection = [];
        $data = $this->resource->fetchAll($builder);

        foreach ($data as $item) {
            $post = App::getContainer()->get('Post');
            $post->id = $item['id'];
            $post->title = $item['title'];
            $post->description = $item['description'];

            $collection[] = $post;
        }

        return $collection;
    }
    
    /**
     * Get a single Post object from its ID
     *
     * @param  mixed $id
     *
     * @return Post
     */
    public function load($id) : Post
    {
        $builder = App::getContainer()->get('Select');        
        $builder->select($this->getColumns())
                ->from('posts')
                ->where('id = :id');

        $bindings = [':id' => $id];

        $data = $this->resource->fetchOne($builder, $bindings);
        
        $post = App::getContainer()->get('Post');
        $post->id = $data['id'];
        $post->title = $data['title'];
        $post->description = $data['description'];

        return $post;
    }

    /**
     * Save a new Post object to the DB
     *
     * @param  mixed $post
     *
     * @return void
     */
    public function save(Post $post) : bool
    {
        $builder = App::getContainer()->get('Insert');
        $builder->insert(['title', 'description'])
                ->into('posts')
                ->values(':title, :description');

        $bindings = [':title' => $post->title, ':description' => $post->description];
        
        return $this->resource->insert($builder, $bindings);
    }

    /**
     * Update an existing Post object in the DB
     *
     * @param  mixed $post
     *
     * @return void
     */
    public function update(Post $post) : bool
    {
        $builder = App::getContainer()->get('Update');
        $builder->update('posts')
                ->set('title=:title, description=:description')
                ->where('id=:id');

        $bindings = [':title' => $post->title, ':description' => $post->description, ':id' => $post->id];
        return $this->resource->update($builder, $bindings);
    }

    /**
     * Remove a specific post from the DB
     *
     * @param  mixed $post
     *
     * @return bool
     */
    public function delete(Post $post) : bool
    {
        $builder = App::getContainer()->get('Delete');
        $builder->delete()
                ->from('posts')
                ->where('id=:id');

        $bindings = [':id' => $post->id];
        return $this->resource->delete($builder, $bindings);
    }

    /**
     * Get an array of permitted columns when fetching data
     *
     * @return array
     */
    private function getColumns() : array
    {
        return ['id','title','description'];
    }
}