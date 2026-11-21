<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\PostEntity;
use App\Models\CategoryModel;
use App\Models\PostModel;
use App\Models\PostCategoryModel;
use App\Models\UserModel;

class PostController extends BaseController
{


    protected $postModel;
    protected $postCategoryModel;
    public function __construct()
    {
        $this->postModel = new PostModel();
        $this->postCategoryModel = new PostCategoryModel();
        $this->userModel = new UserModel();

    }

    protected function getPostOr404($id)
    {
        $post = $this->postModel->find($id);
        if (!$post) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Post with ID $id not found");
        }
        return $post;
    }

    public function index()
    {
        //dd(session()->get('current_user'));
        $posts = $this->postModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/posts/index', [
            'posts' => $posts,
            'title' => 'Posts'
        ]);
    }

    public function create()
    {
        $post = new PostEntity();
        $users = $this->userModel->findAll();
 
        $categories = (new \App\Models\CategoryModel())->findAll();
        return view('admin/posts/create', [
            'post' => $post,
            'categories' => $categories,
            'title' => 'Create Post',
            'selectedCategoryIds' => [],
            'users' => $users
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        if(!session()->get('current_user')['is_admin']) {
            $data['user_id'] = session()->get('current_user')['id']; // Replace 1 with the actual user ID of the logged-in user
        }
        $categories = $data['categories'] ?? [];
        
        $id = $this->postModel->insert($data);

        // check if insert was successful
        if (!$id) {
            return redirect()->back()
            ->withInput()
            ->with('message', ['type' => 'danger', 'text' => 'Failed to create post'])
            ->with('errors', $this->postModel->errors());
        }
        
        // associate post with categories if any are selected
        if ($id && !empty($categories)) {
            foreach ($categories as $categoryId) {
                $this->postCategoryModel->insert([
                    'post_id' => $id,
                    'category_id' => $categoryId
                ]);
            }
        }



        return redirect()
            ->with('message', ['type' => 'success', 'text' => 'Post created successfully'])
            ->route('admin.posts.index');
    }

    public function show($id)
    {
        $post = $this->getPostOr404($id);
        return view('admin/posts/show', [
            'post' => $post,
            'title' => $post->title
        ]);
    }
    
    public function delete($id)
    {
        $post = $this->getPostOr404($id);
        return view('admin/posts/delete', [
            'post' => $post,
            'title' => 'Delete Post'
        ]);
    }
    
    public function destroy($id)
    {
        $post = $this->getPostOr404($id);
        if (!$this->postModel->delete($id)) {
            return redirect()->back()
                ->with('message', ['type' => 'danger', 'text' => 'Failed to delete post']);
        }
        return redirect()
            ->with('message', ['type' => 'success', 'text' => 'Post deleted successfully'])
            ->route('admin.posts.index');
    }

    public function edit($id)
    {
        $post = $this->getPostOr404($id);
        $categories = (new CategoryModel())->findAll();
        $users = $this->userModel->findAll();

        // get selected category IDs for the post (to pre-check checkboxes in the form)
        $selectedCategoryIds = array_map(function($category) {
            return $category->id;
        }, $this->postModel->getCategories((int)$id));
   
        return view('admin/posts/edit', [
            'post' => $post,
            'title' => 'Edit Post',
            'categories' => $categories,
            'selectedCategoryIds' => $selectedCategoryIds,
            'users' => $users
        ]);
    }

    public function update($id)
    {
        $post = $this->getPostOr404($id);
        $data = $this->request->getPost();


        // sanitize category IDs (convert to integers)
        $categoryIds = array_map(
            'intval',
            (array) ($data['categories'] ?? [])
        );
        // remove duplicates and invalid IDs (non-positive integers)
        $categoryIds = array_values(array_unique(array_filter(
            $categoryIds,
            static fn($categoryId) => $categoryId > 0
        )));
        unset($data['categories']);
        // postmodel
        if (!$this->postModel->update($id, $data)) {
            return redirect()->back()
                ->withInput()
                ->with('message', ['type' => 'danger', 'text' => 'Failed to update post'])
                ->with('errors', $this->postModel->errors());
        }

        // update posts categories (delete old and insert new)
        $this->postCategoryModel->where('post_id', $id)->delete();
        foreach ($categoryIds as $categoryId) {
            $this->postCategoryModel->insert([
                'post_id' => $id,
                'category_id' => $categoryId
            ]);
        }
        return redirect()
            ->with('message', ['type' => 'success', 'text' => 'Post updated successfully'])
            ->route('admin.posts.index');
    }


}
