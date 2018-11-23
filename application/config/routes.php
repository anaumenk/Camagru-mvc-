<?php

return [
    //Main

    '' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    '{page:\d+}' => [
        'controller' => 'main',
        'action' => 'index',
    ],

    'enter' => [
        'controller' => 'main',
        'action' => 'enter',
    ],

    'enter/login' => [
        'controller' => 'main',
        'action' => 'login',
    ],

    'enter/register' => [
        'controller' => 'main',
        'action' => 'register',
    ],

    'activate/{token:\w+}' => [
        'controller' => 'main',
        'action' => 'activate',
    ],

    'enter/login/recover' => [
        'controller' => 'main',
        'action' => 'recover',
    ],

    'logout' => [
        'controller' => 'main',
        'action' => 'logout',
    ],

    //Profile

    'profile' => [
        'controller' => 'profile',
        'action' => 'profile',
    ],

    'profile/{page:\d+}' => [
        'controller' => 'profile',
        'action' => 'profile',
    ],

    'profile/add_picture' => [
        'controller' => 'profile',
        'action' => 'add_picture',
    ],

    'profile/edit' => [
        'controller' => 'profile',
        'action' => 'edit',
    ],
];