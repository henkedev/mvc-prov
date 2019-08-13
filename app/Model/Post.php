<?php

namespace App\Model;

use Core\Model;

class Post extends Model
{
    public $id;
    public $title;
    public $description;

    /**
     * Setup rules for validation and resolve through the model
     *
     * @return void
     */
    public function validate() {
        $protocol = [
            'title' => [
                'value' => $this->title,                
                'rules' => [
                    'required' => 'Title is required',
                    'no-digits' => 'Title cannot have digits'
                ],            
            ],
            
            'description' => [
                'value' => $this->description,
                'rules' => [
                    'required' => 'Description is required',
                    'no-html' => 'No HTML allowed in description'
                ]                
            ]
        ];

        return $this->resolve($protocol);
    }
}