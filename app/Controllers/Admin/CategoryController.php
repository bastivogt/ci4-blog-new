<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Entities\CategoryEntity;    

class CategoryController extends BaseController
{

    protected $model;

    protected function __construct()
    {
        $this->model = new CategoryModel();
    }

    protected function getObjectOr404(int $id): CategoryEntity
    {
        $category = $this->model->find($id);
        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Category with ID $id not found");
        }
        return $category;
    }

    public function index()
    {
        $categories = $this->model->findAll();
        return view('categories/index', [
            'categories' => $categories,
            'title' => 'Categories'
            ]);
    }
}