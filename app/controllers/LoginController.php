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
            $this->loginService->login($this->getRequestDataBody());
        } catch (\Exception $exception) {
            http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }

        echo json_encode([
            'status' => 'success',
        ]);
    }

    public function logoutAction()
    {
        try {
            $this->loginService->logout();
        } catch (\Exception $exception) {
            http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }

        echo json_encode([
            'status' => 'success',
        ]);
    }

    public function isLoginAction()
    {
        try {
            $res = $this->loginService->isLogin();
        } catch (\Exception $exception) {
            http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }

        echo json_encode([
            'status' => $res,
        ]);
    }
}