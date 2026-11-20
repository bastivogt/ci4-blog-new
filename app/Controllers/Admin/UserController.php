<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class UserController extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new \App\Models\UserModel();
    }

    protected function getUserOr404($id)
    {
        $user = $this->userModel->find($id);
        if (!$user) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("User with ID $id not found");
        }
        return $user;
    }

    public function index()
    {
        return view('admin/users/index', [
            'title' => 'Users',
            'users' => $this->userModel->findAll()
            //'users' => $this->userModel->where('id !=', session()->get('current_user')['id'])->findAll()
        ]);
    }

    public function create()
    {
        return view('admin/users/create', [
            'title' => 'Create User'
        ]);
    }

    public function store()
    {
        $data = $this->request->getPost();
      
        // check password and confirm password match
        if(empty($data['password']) || $data['password'] !== $data['password_confirm']) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Password and confirm password do not match.'
                ])
                ->withInput();
        }
        // hash the password before saving
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        unset($data['password_confirm']); // remove confirm password before saving
        
        $id = $this->userModel->insert($data);
        if (!$id) {
            // Handle the error, e.g., show a message or redirect back with an error
            return redirect()
                
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Failed to create user.'
                ])
                ->with('errors', $this->userModel->errors())
                ->withInput()
                ->back();
        }
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'User created successfully.'
            ])
            ->route('admin.users.index');
    }


    function edit($id)
    {
        $user = $this->getUserOr404($id);
        return view('admin/users/edit', [
            'title' => 'Edit User',
            'user' => $user
        ]);
    }

    public function update($id)
    {
        $user = $this->getUserOr404($id);
        $data = $this->request->getPost();

        // add the id to the data array for validation purposes
        $data['id'] = $id;

        // check password and confirm password match if password is provided
        if(!empty($data['password']) && $data['password'] !== $data['password_confirm']) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Password and confirm password do not match.'
                ])
                ->withInput();
        }
        if(!empty($data['password'])) {
            $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        }else{
            // return redirect()
            //     ->back()
            //     ->with('message', [
            //         'type' => 'danger', 
            //         'text' => 'Password cannot be empty if provided.'
            //     ])
            //     ->withInput();
            unset($data['password']);
        }
        unset($data['password_confirm']); // remove confirm password before saving

        

        if (!$this->userModel->update($id, $data)) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Failed to update user.'
                ])
                ->with('errors', $this->userModel->errors())
                ->withInput();
        }
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'User updated successfully.'
            ])
            ->route('admin.users.index');
    }


    public function delete($id)
    {
        $user = $this->getUserOr404($id);
        return view('admin/users/delete', [
            'title' => 'Delete User',
            'user' => $user
        ]);
    }

    public function destroy($id)
    {
        $user = $this->getUserOr404($id);
        if (!$this->userModel->delete($id)) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Failed to delete user.'
                ]);
        }
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'User deleted successfully.'
            ])
            ->route('admin.users.index');
    }
}
