<?php

namespace app\controllers;

use app\services\LoginService;
use app\services\QuestionnairesService;
use core\Controller;

class QuestionnairesController extends Controller
{
    public $questionnairesService;
    public $loginService;

    public function __construct($route)
    {
        parent::__construct($route);

        $this->questionnairesService = new QuestionnairesService();
        $this->loginService = new LoginService();
    }

    public function storeAction()
    {
        try {
            if (! $this->loginService->isLogin()) {
                throw new \Exception('Forbidden', 403);
            }

            $this->questionnairesService->store($this->getRequestDataBody());

            echo json_encode([
                'status' => 'success',
            ]);
        } catch (\Exception $exception) {
            //http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }
}