<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\CommentEntity;

class CommentModel extends Model
{
    protected $table            = 'comments';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = CommentEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'post_id', 
        'author', 
        'content', 
        'created_at', 
        'updated_at'
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'post_id' => 'required|integer',
        'author' => 'required|string|max_length[255]',
        'content' => 'required|string|max_length[1000]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    public function getCommentsWithPostTitle()
    {
        return $this->builder()
            ->select('comments.*, posts.title as post_title')
            ->join('posts', 'posts.id = comments.post_id')
            ->get()
            ->getResultArray();
    }

    public function getCommentWithPostTitle(int $id)
    {
        return $this->builder()
            ->select('comments.*, posts.title as post_title')
            ->join('posts', 'posts.id = comments.post_id')
            ->where('comments.id', $id)
            ->get()
            ->getRowArray();
    }
}
