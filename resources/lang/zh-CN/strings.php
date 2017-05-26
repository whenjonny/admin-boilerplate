<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Strings Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used in strings throughout the system.
    | Regardless where it is placed, a string can be listed here so it is easily
    | found in a intuitive way.
    |
    */

    'backend' => [
        'access' => [
            'users' => [
                'delete_user_confirm'  => '您确定要永久删除此用户吗? 引用此用户ID的应用程序中的任何地方都很可能会出错. 继续需要您自担风险. 这不能被撤消.',
                'if_confirmed_off'     => '(如果确认关闭)',
                'restore_user_confirm' => '将此用户恢复到原始状态?',
            ],
        ],

        'dashboard' => [
            'title'   => '管理信息中心',
            'welcome' => '欢迎',
        ],

        'general' => [
            'all_rights_reserved' => '版权所有.',
            'are_you_sure'        => '确定?',
            'boilerplate_link'    => 'laravel 5 模版',
            'continue'            => '继续',
            'member_since'        => '会员自',
            'minutes'             => ' 分钟',
            'search_placeholder'  => '搜索...',
            'timeout'             => '由于您没有进行任何活动，因此出于安全考虑，您已自动注销 ',

            'see_all' => [
                'messages'      => '查看所有消息',
                'notifications' => '查看全部',
                'tasks'         => '查看全部任务',
            ],

            'status' => [
                'online'  => '线上',
                'offline' => '线下',
            ],

            'you_have' => [
                'messages' => '{0} 没有消息|{1} 您有1个消息|[2,Inf] 您有:number个消息',
                'notifications' => '{0} 没有通知|{1} 您有1个通知|[2,Inf] 您有:number个通知',
                'tasks' => '{0} 没有任务|{1} 您有1个任务|[2,Inf] 您有:number个任务',
            ],
        ],

        'search' => [
            'empty'      => '请输入一个搜索词.',
            'incomplete' => '您必须为此系统编写自己的搜索逻辑.',
            'title'      => '搜索结果',
            'results'    => '搜索结果 :query',
        ],

        'welcome' => '<p>管理面板</p>',
    ],

    'emails' => [
        'auth' => [
            'error'                   => '哎呦!',
            'greeting'                => '你好!',
            'regards'                 => '问候,',
            'trouble_clicking_button' => '如果您无法单击 : action_text 按钮，请将以下URL复制并粘贴到Web浏览器中：',
            'thank_you_for_using_app' => '感谢您使用我们的应用程序!',

            'password_reset_subject'    => '重设密码',
            'password_cause_of_email'   => '您收到此电子邮件是因为我们收到您的帐户的密码重置请求.',
            'password_if_not_requested' => '您收到此电子邮件是因为我们收到您的帐户的密码重置请求.',
            'reset_password'            => '点击此处重置您的密码',

            'click_to_confirm' => '点击此处确认您的帐户:',
        ],
    ],

    'frontend' => [
        'test' => '测试',

        'tests' => [
            'based_on' => [
                'permission' => '基于权限 - ',
                'role'       => '基于角色- ',
            ],

            'js_injected_from_controller' => '从控制器注入的Javascript',

            'using_blade_extensions' => '使用刀片扩展',

            'using_access_helper' => [
                'array_permissions'     => '使用访问助手与权限名称或ID的数组，用户必须拥有所有.',
                'array_permissions_not' => '使用访问助手与权限名称或ID的数组，用户不必拥有所有权限.',
                'array_roles'           => '使用访问助手与角色名称或ID的数组，用户必须拥有所有.',
                'array_roles_not'       => '使用访问助手与角色名称或ID的数组，用户不必拥有所有.',
                'permission_id'         => '使用具有权限ID的访问助手',
                'permission_name'       => '使用访问助手与权限名称',
                'role_id'               => '使用访问助手与角色ID',
                'role_name'             => '使用访问助手与角色名称',
            ],

            'view_console_it_works'          => '查看控制台，你应该看到它的工作！这是来自前端控制器 @索引',
            'you_can_see_because'            => '你可以看到这个，因为你有角色 :role！',
            'you_can_see_because_permission' => '你可以看到这个，因为你有权限的 :permission !',
        ],

        'user' => [
            'change_email_notice' => '更改您的电子邮件，您将被注销，直到您确认新的电子邮件地址为止.',
            'email_changed_notice' => '您必须先确认新的电子邮件地址，然后再重新登录.',
            'profile_updated'  => '档案成功更新.',
            'password_updated' => '密码成功更新.',
        ],

        'welcome_to' => '欢迎来到 :place',
    ],
];
