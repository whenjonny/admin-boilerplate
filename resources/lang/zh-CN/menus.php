<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Menus Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in menu items throughout the system.
    | Regardless where it is placed, a menu item can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'title' => '访问控制管理',

            'permissions' => [
                'all' => '所有权限',
                'create' => '创建权限',
                'edit' => '编辑权限',
                'groups' => [
                    'all' => '所有权限组',
                    'create' => '创建权限组',
                    'edit' => '编辑权限组',
                    'main' => '权限组',
                ],
                'main' => '权限',
                'management' => '权限管理',
            ],

            'roles' => [
                'all' => '所有角色',
                'create' => '创建角色',
                'edit' => '编辑角色',
                'management' => '角色管理',
                'main' => '角色',
            ],

            'users' => [
                'all' => '所有用户',
                'change-password' => '修改密码',
                'create' => '创建用户',
                'deactivated' => '关闭的用户',
                'deleted' => '删除的用户',
                'edit' => '编辑用户',
                'main' => '用户',
            ],
        ],

        'log-viewer' => [
            'main' => '日志查看器',
            'dashboard' => '仪表盘',
            'logs' => '日志',
        ],

        'sidebar' => [
            'dashboard' => '仪表盘',
            'general' => '基本',
        ],
    ],

    'language-picker' => [
        'language' => '语言',
        'langs' => [
            'en' => '英',
            'fr-FR' => '法',
            'it' => '意',
            'sv' => '瑞典',
        ],
    ],
];
