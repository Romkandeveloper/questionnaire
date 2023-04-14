<?php

namespace app\controllers;

use app\services\LoginService;
use core\Controller;

class LoginController extends Controller
{
    public $loginService;

    public function __construct($route)
    {
        parent::__construct($route);

        $this->loginService = new LoginService();
    }

    public function loginAction()
    {
        try {
            $res = $this->loginService->login($this->getRequestDataBody());
            echo json_encode([
                'status' => 'success',
                'user' => $res,
            ]);
        } catch (\Exception $exception) {
            http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function logoutAction()
    {
        try {
            $this->loginService->logout();
            echo json_encode([
                'status' => 'success',
            ]);
        } catch (\Exception $exception) {
            http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function isLoginAction()
    {
        try {
            $res = $this->loginService->isLogin();
            echo json_encode([
                'status' => $res['status'],
                'user' => $res['user']
            ]);
        } catch (\Exception $exception) {
            http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }
}