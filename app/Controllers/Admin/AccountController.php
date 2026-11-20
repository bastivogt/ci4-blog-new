<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AccountController extends BaseController
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



    public function edit()
    {
        $currentUser = session()->get('current_user');
        $user = $this->getUserOr404($currentUser['id']);
        return view('admin/account/edit', [
            'title' => 'Edit Account',
            'user' => $user
        ]);
    }


    public function update()
    {
        $currentUser = session()->get('current_user');
        $user = $this->getUserOr404($currentUser['id']);
        $data = $this->request->getPost();

        // add the id to the data array for validation purposes
        $data['id'] = (int)$currentUser['id'];



        if (!$this->userModel->update($currentUser['id'], $data)) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Failed to update account.'
                ])
                ->with('errors', $this->userModel->errors())
                ->withInput();
        }
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'Account updated successfully.'
            ])
            ->route('admin.account.edit');
    }


    public function editPassword()
    {
        $currentUser = session()->get('current_user');
        $user = $this->getUserOr404($currentUser['id']);
        return view('admin/account/change_password', [
            'title' => 'Change Password',
            'user' => $user
        ]);
    }

    public function updatePassword()
    {

        helper('user_session');


        $currentUser = session()->get('current_user');
        $user = $this->getUserOr404($currentUser['id']);
        $data = $this->request->getPost();

        // add the id to the data array for validation purposes
        $data['id'] = (int)$currentUser['id'];

        if(!empty($data['new_password']) && $data['new_password'] !== $data['confirm_password']) {
            if(!password_verify($data['current_password'], $user->password)) {
                return redirect()
                    ->back()
                    ->with('message', [
                        'type' => 'danger', 
                        'text' => 'Old password is incorrect.'
                    ])
                    ->withInput();
            }

            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Password and confirm password do not match.'
                ])
                ->withInput();
        }
        if(!empty($data['new_password'])) {
            $data['password'] = password_hash($data['new_password'], PASSWORD_DEFAULT);
        }else{
            unset($data['password']);
        }
        unset($data['new_password']);
        unset($data['confirm_password']); // remove confirm password before saving

        if (!$this->userModel->update($currentUser['id'], $data)) {
            return redirect()
                ->back()
                ->with('message', [
                    'type' => 'danger', 
                    'text' => 'Failed to update password.'
                ])
                ->with('errors', $this->userModel->errors())
                ->withInput();
        }
        clear_current_user_session();
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'Password updated successfully.'
            ])
            ->route('admin.auth.login.form');
    }
}
