<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\HTTP\RedirectResponse;

class AuthController extends BaseController
{
    public function index(): string|RedirectResponse
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to(site_url('dashboard'));
        }

        return view('auth/login', [
            'title' => 'Login',
        ]);
    }

    public function login(): RedirectResponse
    {
        $rules = [
            'username' => 'required|max_length[50]',
            'password' => 'required|max_length[255]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $username = trim((string) $this->request->getPost('username'));
        $password = (string) $this->request->getPost('password');

        $user = (new UserModel())->where('username', $username)->first();

        if ($user === null || ! password_verify($password, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid username or password.');
        }

        $session = session();
        $session->regenerate();
        $session->set([
            'user_id'     => (int) $user['id'],
            'username'    => $user['username'],
            'full_name'   => $user['full_name'],
            'role'        => $user['role'],
            'isLoggedIn'  => true,
        ]);

        return redirect()->to(site_url('dashboard'))->with('success', 'Welcome to Binan City Hall Lost and Found Registry.');
    }

    public function logout(): RedirectResponse
    {
        session()->destroy();

        return redirect()->to(site_url('login'))->with('success', 'You have been logged out.');
    }
}
