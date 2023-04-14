<?php

return [
    array(
        'path' => '',
        'method' => 'get',
        'controller' => 'main',
        'action' => 'index',
    ),

    array(
        'path' => 'api/register',
        'method' => 'post',
        'controller' => 'register',
        'action' => 'register',
    ),

    array(
        'path' => 'api/login',
        'method' => 'post',
        'controller' => 'login',
        'action' => 'login',
    ),

    array(
        'path' => 'api/logout',
        'method' => 'post',
        'controller' => 'login',
        'action' => 'logout',
    ),

    array(
        'path' => 'api/login/status',
        'method' => 'get',
        'controller' => 'login',
        'action' => 'isLogin',
    ),

    array(
        'path' => 'api/questionnaire',
        'method' => 'post',
        'controller' => 'questionnaires',
        'action' => 'store',
    ),

    array(
        'path' => 'api/questionnaire',
        'method' => 'delete',
        'controller' => 'questionnaires',
        'action' => 'destroy',
    ),

//     array(
//         'path' => 'api/questionnaire',
//         'method' => 'get',
//         'controller' => 'questionnaires',
//         'action' => 'index',
//     ),

    array(
        'path' => 'api/questionnaire/custom',
        'method' => 'get',
        'controller' => 'questionnaires',
        'action' => 'getCustom',
    ),
];