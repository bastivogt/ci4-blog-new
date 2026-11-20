<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthController extends BaseController
{
    


    protected $userModel;


    public function __construct()
    {
        $this->userModel = new UserModel();
    }


    public function showRegisterForm()
    {
        //
    }

    public function register()
    {
        //
    }

    public function showLoginForm()
    {
        if (session()->has('current_user')) {
            return redirect()->route('admin.dashboard.index');
        }
        return view('admin/auth/login', ['title' => 'Login']);
    }

    public function login()
    {
        if (session()->has('current_user')) {
            return redirect()->route('admin.dashboard.index');
        }
    
        $data = $this->request->getPost();
        $user = $this->userModel->findByEmail($data['email']);
        if ($user && $user->is_active != 1) {
            return redirect()
                ->back()
                ->with('errors', ['Your account is inactive'])
                ->withInput();
        }

        
        if (!$user || !password_verify($data['password'], $user->password)) {
            return redirect()
                ->back()
                ->with('errors', ['Invalid email or password'])
                ->withInput();
        }
        // Set user session or perform login actions here
        session()->set('current_user', [
            'id' => $user->id,
            'email' => $user->email,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'is_admin' => $user->is_admin
        ]);
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'You have logged in successfully.'
            ])
            ->route('admin.dashboard.index'); // Redirect to a protected page after login
    }

    public function logout()
    {
        session()->remove('current_user');
        // regenerate the session ID to prevent session fixation attacks
        session()->regenerate();
        return redirect()
            ->with('message', [
                'type' => 'success',
                'text' => 'You have been logged out successfully.'
            ])
            ->route('admin.auth.login.form');
    }
}
