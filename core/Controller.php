<?php

namespace core;

abstract class Controller
{
    public $route;
    public $model;

    public function __construct(array $route)
    {
        $this->route = $route;
        $this->model = $this->loadModel(
            array_key_exists('controller', $route)
                ? $route['controller']
                : null
        );
    }

    public function loadModel($name)
    {
        $path = 'app\models\\' . ucfirst($name);
        if (class_exists($path)) {
            return new $path();
        }
    }

    function getRequestDataBody()
    {
        $body = file_get_contents('php://input');

        if (empty($body)) {
            return [];
        }

        $data = json_decode($body, true);
        if (json_last_error()) {
            trigger_error(json_last_error_msg());
            return [];
        }

        return $data;
    }
}