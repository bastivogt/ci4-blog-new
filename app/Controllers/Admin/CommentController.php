<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Entities\CommentEntity;

class CommentController extends BaseController
{
    protected $commentModel;
    protected $postModel;

    public function __construct()
    {
        $this->commentModel = new \App\Models\CommentModel();
        $this->postModel = new \App\Models\PostModel();
    }

    protected function getCommentOr404(int $id)
    {
        $comment = $this->commentModel->getCommentWithPostTitle($id);
        if (!$comment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Comment with ID $id not found");
        }
        return $comment;
    }




    public function index()
    {
        //$comments = $this->commentModel->findAll();
        $comments = $this->commentModel->getCommentsWithPostTitle();
        return view('admin/comments/index', [
            'comments' => $comments,
            'title' => 'Comments'
        ]);
    }


    public function show(int $id)
    {
        $comment = $this->getCommentOr404($id);
        return view('admin/comments/show', [
            'comment' => $comment,
            'title' => 'Comment Details'
        ]);
    }   


    public function create()
    {
        $posts = $this->postModel->findAll();
        return view('admin/comments/create', [
            'posts' => $posts,
            'title' => 'Create Comment'
        ]);
    }   

    public function store()
    {
        $data = $this->request->getPost();
        $comment = new CommentEntity($data);
        $id = $this->commentModel->insert($comment);
        if (!$id) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Failed to create comment'
                ])
                ->with('errors', $this->commentModel->errors())
                ->withInput();
        }
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'Comment created successfully'
            ])
            ->route('admin.comments.index');
    }


    public function edit(int $id)
    {
        $comment = $this->getCommentOr404($id);
        $posts = $this->postModel->findAll();
        return view('admin/comments/edit', [
            'comment' => $comment,
            'posts' => $posts,
            'title' => 'Edit Comment'
        ]);
    }

    public function update(int $id)
    {
        $comment = $this->getCommentOr404($id); 
         
        $data = $this->request->getPost();
        
        if (!$this->commentModel->update($id, $data)) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Failed to update comment'
                ])
                ->with('errors', $this->commentModel->errors())
                ->withInput();
        }
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'Comment updated successfully'
            ])
            ->route('admin.comments.index');
    }


    public function delete(int $id)
    {
        $comment = $this->getCommentOr404($id);

        return view('admin/comments/delete', [
            'comment' => $comment,
            'title' => 'Delete Comment'
        ]);
    }

    public function destroy(int $id)
    {
        $comment = $this->getCommentOr404($id);
        if (!$this->commentModel->delete($id)) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Failed to delete comment'
                ]);
        }
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'Comment deleted successfully'
            ])
            ->route('admin.comments.index');
    }
}
