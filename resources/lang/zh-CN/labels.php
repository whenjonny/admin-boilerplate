<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Labels Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in labels throughout the system.
    | Regardless where it is placed, a label can be listed here so it is easily
    | found in a intuitive way.
    |
     */

    'general' => [
        'all' => '所有',
        'actions' => '操作',
        'buttons' => [
            'save' => '保存',
            'update' => '更新',
        ],
        'hide' => '隐藏',
        'none' => '无',
        'show' => '显示',
        'toggle_navigation' => '导航开关',
    ],

    'backend' => [
        'access' => [
            'permissions' => [
                'create' => '创建权限',
                'dependencies' => '权限依赖',
                'edit' => '编辑权限',

                'groups' => [
                    'create' => '创建权限组',
                    'edit' => '编辑权限组',

                    'table' => [
                        'name' => '名称',
                    ],
                ],

                'grouped_permissions' => '组合权限',
                'label' => '权限',
                'management' => '权限管理',
                'no_groups' => '没有权限组',
                'no_permissions' => '没有权限可选',
                'no_roles' => '没有角色可设置',
                'no_ungrouped' => '没有零散权限',

                'table' => [
                    'dependencies' => '依赖',
                    'group' => '权限组',
                    'group-sort' => '组排序',
                    'name' => '名称',
                    'permission' => '权限',
                    'roles' => '角色',
                    'system' => '系统',
                    'total' => '个权限|个权限',
                    'users' => '用户',
                ],

                'tabs' => [
                    'general' => '基本',
                    'groups' => '所有权限组',
                    'dependencies' => '依赖',
                    'permissions' => '所有权限',
                ],

                'ungrouped_permissions' => '零散权限',
            ],

            'roles' => [
                'create' => '创建角色',
                'edit' => '编辑角色',
                'management' => '角色管理',

                'table' => [
                    'number_of_users' => '用户数量',
                    'permissions' => '权限',
                    'role' => '角色',
                    'sort' => '排序',
                    'total' => '个角色|个角色',
                ],
            ],

            'users' => [
                'active' => '活动用户',
                'all_permissions' => '所有权限',
                'change_password' => '修改密码',
                'change_password_for' => '修改:user的用户密码',
                'create' => '创建用户',
                'deactivated' => '关闭用户',
                'deleted' => '删除用户',
                'dependencies' => '依赖',
                'edit' => '编辑用户',
                'management' => '用户管理',
                'no_other_permissions' => '没有其他权限',
                'no_permissions' => '没有权限',
                'no_roles' => '没有角色可设置',
                'permissions' => '权限',
                'permission_check' => '检查用户权限时同时会检查该权限的依赖权限。',

                'table' => [
                    'confirmed' => '已确认',
                    'created' => '创建于',
                    'email' => 'E-mail',
                    'id' => 'ID',
                    'last_updated' => '最后更新',
                    'name' => '名称',
                    'no_deactivated' => '没有关闭的用户',
                    'no_deleted' => '没有已删除的用户',
                    'other_permissions' => '其他权限',
                    'roles' => '角色',
                    'total' => '个用户|个用户',
                ],
            ],
        ],
    ],

    'frontend' => [

        'auth' => [
            'login_box_title' => '登录',
            'login_button' => '登录',
            'login_with' => '使用:social_media登录',
            'register_box_title' => '注册',
            'register_button' => '注册',
            'remember_me' => '记住我',
        ],

        'passwords' => [
            'forgot_password' => '忘记密码？',
            'reset_password_box_title' => '重置密码',
            'reset_password_button' => '重置密码',
            'send_password_reset_link_button' => '发送密码重置链接',
        ],

        'macros' => [
            'country' => [
                'alpha' => 'Country Alpha Codes',
                'alpha2' => 'Country Alpha 2 Codes',
                'alpha3' => 'Country Alpha 3 Codes',
                'numeric' => 'Country Numeric Codes',
            ],

            'macro_examples' => 'Macro Examples',

            'state' => [
                'mexico' => 'Mexico State List',
                'us' => [
                    'us' => 'US States',
                    'outlying' => 'US Outlying Territories',
                    'armed' => 'US Armed Forces',
                ],
            ],

            'territories' => [
                'canada' => 'Canada Province & Territories List',
            ],

            'timezone' => 'Timezone',
        ],

        'user' => [
            'passwords' => [
                'change' => '修改密码',
            ],

            'profile' => [
                'avatar' => '头像',
                'created_at' => '创建于',
                'edit_information' => '编辑个人信息',
                'email' => 'E-mail',
                'last_updated' => '最后更新',
                'name' => '名称',
                'update_information' => '更新用户信息',
            ],
        ],

    ],
];
