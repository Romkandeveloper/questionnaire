<?php

return [
    '' => [
        'controller' => 'main',
        'action' => 'index',
        'method' => 'get',
    ],

    'api/register' => [
        'controller' => 'register',
        'action' => 'register',
        'method' => 'post',
    ],

    'api/login' => [
        'controller' => 'login',
        'action' => 'login',
        'method' => 'post',
    ],

    'api/logout' => [
        'controller' => 'login',
        'action' => 'logout',
        'method' => 'post',
    ],

    'api/login/status' => [
        'controller' => 'login',
        'action' => 'isLogin',
        'method' => 'get',
    ],
];