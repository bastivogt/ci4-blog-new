<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Entities\UserEntity;

class UserModel extends Model
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = UserEntity::class;
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'email',
        'password',
        'first_name',
        'last_name',
        'is_admin',
        'is_active',
        'username'
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
        'id'         => 'permit_empty|is_natural_no_zero',
        'email'      => 'required|valid_email|is_unique[users.email,id,{id}]',
        'password'   => 'permit_empty|min_length[8]',
        'first_name' => 'required|regex_match[/\A[\p{L} ]+\z/u]|min_length[2]',
        'last_name'  => 'required|regex_match[/\A[\p{L} ]+\z/u]|min_length[2]',
        'username'   => 'required|alpha_numeric|min_length[3]|is_unique[users.username,id,{id}]',
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


    public function findByEmail(string $email)
    {
        return $this->where('email', $email)->first();
    }
}
