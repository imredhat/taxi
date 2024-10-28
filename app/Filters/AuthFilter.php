<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // چک کردن لاگین بودن کاربر از طریق user_id در session
        if (!session()->get('user_id')) {
            // اگر user_id در session نباشد، کاربر به صفحه لاگین هدایت می‌شود
            return redirect()->to('/auth/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // در صورت نیاز، کدهای بعد از درخواست اینجا اضافه می‌شوند
    }
}
