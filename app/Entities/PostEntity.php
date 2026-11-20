<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class PostEntity extends Entity
{
    protected $attributes = [
        'is_featured'    => false,
        'is_published'   => true,
        'allow_comments' => true,
    ];
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    public function getExcerpt(): string
    {
        return substr($this->attributes['body'], 0, 100) . '...';
    }   
    protected $appends = ['excerpt'];


    
}
