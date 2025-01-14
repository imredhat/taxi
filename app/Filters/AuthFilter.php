<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\IncomingRequest;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        // چک کردن لاگین بودن کاربر از طریق user_id در session
        // حذف این قانون برای درخواست‌های API
        $request = service('request');
        $uri = $request->getUri()->getPath();
        if ($request->isAJAX() || strpos($request->getHeaderLine('Accept'), 'application/json') !== false || strpos($uri, 'api') || strpos($uri, 'Pay') !== false) {
            return;
        }

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