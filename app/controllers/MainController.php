<?php

namespace app\controllers;

use core\Controller;

class MainController extends Controller
{
    public function indexAction()
    {
        require 'app/views/default.php';
    }
}