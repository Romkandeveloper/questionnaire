<?php

require __DIR__ . '/vendor/autoload.php';
require 'lib/Dev.php';

use core\Router;

spl_autoload_register(function ($class) {
    $path = str_replace('\\', '/', $class . '.php');
    if (file_exists($path)) {
        require $path;
    }
});

$router = new Router;
return $router->run();