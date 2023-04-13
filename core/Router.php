<?php

namespace core;

use app\controllers\MainController;

class Router
{
    protected $routes = [];
    protected $params = [];

    public function __construct()
    {
        $routes = require 'config/routes.php';
        foreach ($routes as $route => $params) {
            $this->add($params);
        }
    }

    /**
     * @param string $route
     * @param array $params
     * @return void
     */
    public function add(array $params)
    {
        $route = '#^' . $params['path'] . '$#';
        $params['path'] = $route;
        $this->routes[] = $params;
    }

    public function match()
    {
        $url = $_SERVER['REQUEST_URI'];
        $method = $_SERVER['REQUEST_METHOD'];
        $getIndex = strrpos($url, '?');
        $url = $getIndex ? substr($url, 0, $getIndex) : $url;
        $url = trim($url, '/');;

        foreach ($this->routes as $route => $params) {
            if (preg_match($params['path'], $url, $matches) && strtolower($method) == $params['method']) {
                $this->params = $params;
                return true;
            }
        }

        return false;
    }

    public function run()
    {
        if (! $this->isApiRoute($_SERVER['REQUEST_URI'])) {
             (new MainController($this->params))->indexAction();
        } else if ($this->match()) {
            header('Content-Type: application/json; charset=utf-8');
            $path = 'app\controllers\\' . ucfirst($this->params['controller']) . 'Controller';
            if (class_exists($path)) {
                $action = $this->params['action'] . 'Action';
                if (method_exists($path, $action)) {
                    $controller = new $path($this->params);
                    $controller->$action();
                } else {
                    header('Status: 503 Service Temporarily Unavailable');
                }
            } else {
                header('Status: 503 Service Temporarily Unavailable');
            }
        } else {
            header('Status: 503 Service Temporarily Unavailable');
        }
    }

    /**
     * @param string $url
     * @return bool
     */
    public function isApiRoute(string $url)
    {
        return str_starts_with($url, '/api');
    }
}
