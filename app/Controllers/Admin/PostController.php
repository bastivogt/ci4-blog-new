<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\PostEntity;

class PostController extends BaseController
{


    protected $postModel;
    public function __construct()
    {
        $this->postModel = new \App\Models\PostModel();
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
        $posts = $this->postModel->orderBy('created_at', 'DESC')->findAll();
        return view('admin/posts/index', [
            'posts' => $posts,
            'title' => 'Posts'
        ]);
    }

    public function create()
    {
        $post = new PostEntity();
        return view('admin/posts/create', [
            'post' => $post,
            'title' => 'Create Post'
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
        $id = $this->postModel->insert($data);
        if (!$id) {
            return redirect()->back()
            ->withInput()
            ->with('message', ['type' => 'danger', 'text' => 'Failed to create post'])
            ->with('errors', $this->postModel->errors());
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
        return view('admin/posts/edit', [
            'post' => $post,
            'title' => 'Edit Post'
        ]);
    }

    public function update($id)
    {
        $post = $this->getPostOr404($id);
        $data = $this->request->getPost();
        if (!$this->postModel->update($id, $data)) {
            return redirect()->back()
                ->withInput()
                ->with('message', ['type' => 'danger', 'text' => 'Failed to update post'])
                ->with('errors', $this->postModel->errors());
        }
        return redirect()
            ->with('message', ['type' => 'success', 'text' => 'Post updated successfully'])
            ->route('admin.posts.index');
    }


}
