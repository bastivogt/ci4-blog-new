<?php

namespace App\Controllers\Admin;

use App\Models\CategoryModel;
use App\Entities\CategoryEntity;  
use App\Controllers\BaseController;

class CategoryController extends BaseController
{

    protected $categoryModel;

    public function __construct()
    {
        $this->categoryModel = new CategoryModel();
    }

    protected function getCategoryOr404(int $id): CategoryEntity
    {
        $category = $this->categoryModel->find($id);
        if (!$category) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException("Category with ID $id not found");
        }
        return $category;
    }

    public function index()
    {
        $categories = $this->categoryModel->orderBy('name', 'ASC')->findAll();
        return view('admin/categories/index', [
            'categories' => $categories,
            'title' => 'Categories'
        ]);
    }

    public function create()
    {
        $category = new CategoryEntity();
        return view('admin/categories/create', [
            'title' => 'Create Category',
            'category' => $category
        ]);
    }
    
    public function store()
    {
        $category = new CategoryEntity($this->request->getPost());
        $id = $this->categoryModel->save($category);
        if (!$id) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message', ['type' => 'danger', 'text' => 'Failed to create category.'])
                ->with('error', 'Failed to create category.');
        }
        return redirect()
            ->with('message', ['type' => 'success', 'text' => 'Category created successfully.'])
            ->route('admin.categories.index');
    }

    public function show(int $id)
    {
        $category = $this->getCategoryOr404($id);
        $posts = $this->categoryModel->getPosts($category->id);
        return view('admin/categories/show', [
            'title' => $category->name,
            'category' => $category,
            'posts' => $posts
        ]);
    }

    public function edit(int $id)
    {
        $category = $this->getCategoryOr404($id);
        $posts = $this->categoryModel->getPosts($category->id);

        return view('admin/categories/edit', [
            'title' => 'Edit Category',
            'category' => $category,
            'posts' => $posts
        ]);
    }
    
    public function update(int $id)
    {
        $category = $this->getCategoryOr404($id);
        $category->fill($this->request->getPost());
        if (!$this->categoryModel->save($category)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('message', ['type' => 'danger', 'text' => 'Failed to update category.'])
                ->with('error', 'Failed to update category.');
        }
        return redirect()
            ->with('message', ['type' => 'success', 'text' => 'Category updated successfully.'])
            ->route('admin.categories.index');
    }

    public function delete(int $id)
    {
        $category = $this->getCategoryOr404($id);
        return view('admin/categories/delete', [
            'title' => 'Delete Category',
            'category' => $category
        ]);
    }
    
    public function destroy(int $id)
    {
        $category = $this->getCategoryOr404($id);
        if (!$this->categoryModel->delete($category->id)) {
            return redirect()
                ->back()
                ->with('message', ['type' => 'danger', 'text' => 'Failed to delete category.']);
        }
        return redirect()
            ->with('message', ['type' => 'success', 'text' => 'Category deleted successfully.'])
            ->route('admin.categories.index');
    }
}