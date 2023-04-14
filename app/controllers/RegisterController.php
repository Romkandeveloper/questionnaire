<?php

namespace app\controllers;

use app\services\RegisterService;
use core\Controller;

class RegisterController extends Controller
{
    public $registerService;

    public function __construct($route)
    {
        parent::__construct($route);

        $this->registerService = new RegisterService();
    }

    public function registerAction()
    {
        try {
            $res = $this->registerService->register($this->getRequestDataBody());
            http_response_code(204);
            echo json_encode([
                'status' => 'success',
                'user' => $res
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