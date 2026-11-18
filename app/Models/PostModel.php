<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\PostEntity;

class PostModel extends Model
{
    protected $table            = 'posts';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = PostEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['title', 'body', 'created_at', 'updated_at'];

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
        'title' => 'required|max_length[255]',
        'body'  => 'required',
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


    public function getCategories(int $postId): array
    {
        // return $this->db->table('categories')
        //     ->select('categories.*')
        //     ->join('posts_categories', 'posts_categories.category_id = categories.id')
        //     ->where('posts_categories.post_id', $postId)
        //     ->get()
        //     ->getResultArray();


        $rows = $this->db->table('categories')
            ->select('categories.*')
            ->join('posts_categories', 'posts_categories.category_id = categories.id')
            ->where('posts_categories.post_id', $postId)
            ->get()
            ->getResultArray();

        return array_map(
            static function (array $row): CategoryEntity {
                return new CategoryEntity($row);
            },
            $rows
        );
    }


    public function getExcerpt(int $postId, int $length = 100): string
    {
        $post = $this->find($postId);
        if ($post) {
            return substr($post->body, 0, $length) . '...';
        }
        return '';
    }
}
