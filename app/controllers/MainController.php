<?php

namespace app\controllers;

use core\Controller;
use core\Model;

class MainController extends Controller
{
    public function indexAction()
    {
        require 'app/views/default.php';
    }
}