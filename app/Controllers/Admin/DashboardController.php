<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
        $currentUser = session()->get('current_user');
        return view('admin/dashboard/index', ['currentUser' => $currentUser]);
    }
}
