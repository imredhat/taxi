<?php

namespace App\Controllers;

use App\Models\AdminModel;


class Auth extends BaseController
{
    protected $adminModel;
    protected $session;


    public function index()
    {
        echo view('auth/login');
    }
    public function login()
    {
        echo view('auth/login');
    }

    public function verify()
    {
        // echo password_hash("S@ber2365", PASSWORD_DEFAULT);
        // die();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');


        $user = new AdminModel();
        $user = $user->where('user', $username)->first();

        if ($user && password_verify($password, $user['pass'])) {

            session()->set([
                'user_id' => $user['id'],
                'name' => $user['name'],
                'isLoggedIn' => true
            ]);

            return redirect()->to(base_url());
        } else {
            return redirect()->back()->with('error', 'نام کاربری یا رمز عبور اشتباه است');
        }
    }

    public function register()
    {
        $data = [
            'username' => $this->request->getPost('username'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ];

        if ($this->adminModel->insert($data)) {
            return redirect()->to('/auth/login')->with('success', 'ثبت نام با موفقیت انجام شد');
        } else {
            return redirect()->back()->with('error', 'ثبت نام انجام نشد');
        }
    }

    public function forgotPassword()
    {
        $email = $this->request->getPost('email');
        $user = $this->adminModel->where('email', $email)->first();

        if ($user) {
            // Generate a reset token and send email logic here
            // For simplicity, we are just returning a success message
            return redirect()->to('/auth/login')->with('success', 'Password reset link sent to your email');
        } else {
            return redirect()->back()->with('error', 'Email not found');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth')->with('success', 'Logged out successfully');
    }
}
