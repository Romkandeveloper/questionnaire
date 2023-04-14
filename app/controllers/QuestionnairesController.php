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

//    public function indexAction()
//    {
//        try {
//            $res = $this->questionnairesService->getAll();
//
//            echo json_encode([
//                'status' => 'success',
//                'items' => $res,
//            ]);
//        } catch (\Exception $exception) {
//
//            echo json_encode([
//                'status' => 'error',
//                'message' => $exception->getMessage(),
//            ]);
//        }
//    }

    public function showAction()
    {
        try {
            if (! $this->loginService->isLogin()) {
                throw new \Exception('Forbidden', 403);
            }

            $res = $this->questionnairesService->getQuestionnaire($_GET['id']);

            echo json_encode([
                'status' => 'success',
                'item' => $res
            ]);
        } catch (\Exception $exception) {
            http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
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
            http_response_code($exception->getCode());
            echo json_encode([
                'status' => 'error',
                'message' => $exception->getMessage(),
            ]);
        }
    }

    public function destroyAction()
    {
        try {
            if (! $this->loginService->isLogin()) {
                throw new \Exception('Forbidden', 403);
            }

            $this->questionnairesService->destroy($_GET['id']);

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

    public function getCustomAction()
    {
        try {
            if (! $this->loginService->isLogin()) {
                throw new \Exception('Forbidden', 403);
            }

            $res = $this->questionnairesService->getCustomQuestionnaires();

            echo json_encode([
                'status' => 'success',
                'items' => $res,
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